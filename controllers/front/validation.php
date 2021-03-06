<?php

class MercuryCashValidationModuleFrontController extends ModuleFrontController
{

    private $available_types = ['BTC', 'ETH', 'DASH'];

    /**
     * This class should be use by your Instant Payment
     * Notification system to validate the order remotely
     */
    public function postProcess()
    {
        /*
         * If the module is not active anymore, no need to process anything.
         */
        if ($this->module->active == false)
            die(Tools::jsonEncode(['data' => ['result'=> false, 'error' => 'Module not active.']]));

        /**
         * Since it is an example, we choose sample data,
         * You'll have to get the correct values :)
         */
        $order_cart  = $this->context->cart;
        $cart_id     = $order_cart->id;
        $customer_id = $order_cart->id_customer;
        $currency_id = $this->context->cart->id_currency;

        /*
         * Restore the context from the $cart_id & the $customer_id to process the validation properly.
         */
        $context           = Context::getContext();
        $context->cart     = new Cart((int) $cart_id);
        $context->customer = new Customer((int) $customer_id);
        $context->currency = new Currency((int) $context->cart->id_currency);
        $context->language = new Language((int) $context->customer->id_lang);

        //get cart currency
        $currency = new Currency($currency_id);
        $currency_iso =  $currency->iso_code;
        if (!$this->checkModuleCurrencies($currency_iso)) {
            die(Tools::jsonEncode(['data' => ['error' => 'Order currency not allowed.']]));
        }

        //get cart parameters
        $amount      = $this->context->cart->getOrderTotal();
        $crypto_type = Tools::getValue('crypto');
        $secure_key  = $context->customer->secure_key;
        $this->context->cookie->__set('secure_key', $secure_key);

        //check crypto type
        if (!in_array($crypto_type, $this->available_types)) {
            die(Tools::jsonEncode(['data' => ['result'=> false, 'error' => 'Wrong crypto currency type.']]));
        }

        //check minimum amount for choosen crypto type
        $minimum_amount = $this->module->getMinimumAmount($crypto_type);
        if ($amount < $minimum_amount) {
            die(Tools::jsonEncode(['data' => ['error' => 'Minimum amount with '.$crypto_type.': '.$minimum_amount.'.']]));
        }

        //get module api keys
        $api_key = $this->module->getApiKey();
        if (!$api_key) {
            die(Tools::jsonEncode(['data' => ['error' => 'Wrong API keys']]));
        }

        //create transaction
        $adapter = $this->getAdapter($api_key);
        $endpoint = new \MercuryCash\SDK\Endpoints\Transaction($adapter);
        $transaction = $this->getTransaction($endpoint, $crypto_type, $currency_iso, $amount);
        if ($transaction === false) {
            die(Tools::jsonEncode(['data' => ['error' => 'Mercury error. Please, try later.']]));
        }

        //get transaction uid;
        $uuid = $transaction->getUuid();

        //checkout transaction
        $checkout = $this->getCheckout($endpoint, $uuid);
        if ($checkout === false) {
            die(Tools::jsonEncode(['data' => ['error' => 'Mercury error. Please, try later.']]));
        }

        //get status of transaction
        $status = $this->getStatus($endpoint, $uuid);
        if ($status === false) {
            die(Tools::jsonEncode(['data' => ['error' => 'Mercury error. Please, try later.']]));
        }

        $address = $transaction->getAddress();
        $crypto_amount = $transaction->getCryptoAmount();
        $type = $this->getType($crypto_type);
        //get qr-code address
        $qr_code = "$type:$address?amount=$crypto_amount&cryptoCurrency=$crypto_type";

        die(Tools::jsonEncode([
            'data' => [
                'cryptoAmount' => $crypto_amount,
                'confirmations' => 5,
                'address' => $address,
                'qrCodeText' => $qr_code,
                'exchangeRate' => $transaction->getRate(),
                'networkFee' => $transaction->getFee(),
                'uuid' => $uuid,
                'cryptoCurrency' => $crypto_type
            ]
        ]));
    }

    /**
     * @return bool
     */
    protected function isValidOrder()
    {
        /*
         * Add your checks right there
         */
        return true;
    }

    /**
     * @param $api_key
     *
     * @return \MercuryCash\SDK\Adapter
     */
    private function getAdapter($api_key)
    {
        return $this->module->isSandbox() ?
            new \MercuryCash\SDK\Adapter($api_key, 'https://api-way.mercurydev.tk') :
            new \MercuryCash\SDK\Adapter($api_key);
    }

    /**
     * @param $currency_iso
     *
     * @return bool
     */
    private function checkModuleCurrencies($currency_iso)
    {
        //get available currencies
        $module_currencies = $this->module->getAvailableCurrencies();
        //if order currency is not equal to one of the module currency we stop process
        if ($module_currencies) {
            $module_currencies_array = array_keys($module_currencies);
            if (!in_array($currency_iso, $module_currencies_array)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param $crypto_type
     *
     * @return string
     */
    private function getType($crypto_type)
    {
        switch ($crypto_type) {
            case 'BTC':
                $type = 'bitcoin';
                break;
            case 'ETH':
                $type = 'ethereum';
                break;
            case 'DASH':
                $type = 'dash';
                break;
            default:
                $type = 'bitcoin';
        }
        return $type;
    }

    /**
     * @param \GuzzleHttp\Exception\BadResponseException $exception
     *
     * @return string
     */
    private function getError(\GuzzleHttp\Exception\BadResponseException $exception)
    {
        $response = $exception->getResponse();
        return $response->getBody()->getContents();
    }

    /**
     * @param $endpoint
     * @param $crypto_type
     * @param $currency_iso
     * @param $amount
     *
     * @return mixed
     */
    private function getTransaction($endpoint, $crypto_type, $currency_iso, $amount)
    {
        try {
            $transaction = $endpoint->create([
                'crypto' => $crypto_type,
                'fiat' => $currency_iso,
                'amount' => $amount,
                'tip' => 0,
            ]);
            return $transaction;
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $this->getError($exception);
        } catch (\GuzzleHttp\Exception\ServerException $exception) {
            $this->getError($exception);
        } catch (Exception $exception) {
        }
        return false;
    }


    /**
     * @param $endpoint
     * @param $uuid
     *
     * @return mixed
     */
    private function getCheckout($endpoint, $uuid)
    {
        try {
            $checkout = $endpoint->process($uuid);
            return $checkout;
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $this->getError($exception);
        } catch (\GuzzleHttp\Exception\ServerException $exception) {
            $this->getError($exception);
        } catch (Exception $exception) {
        }
        return false;
    }


    /**
     * @param $endpoint
     * @param $uuid
     *
     * @return mixed
     */
    private function getStatus($endpoint, $uuid)
    {
        try {
            $status = $endpoint->status($uuid);
            return $status;
        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $this->getError($exception);
        } catch (\GuzzleHttp\Exception\ServerException $exception) {
            $this->getError($exception);
        } catch (Exception $exception) {
        }
        return false;
    }

}
