<?php

namespace MercuryCash\SDK\Requests;

use MercuryCash\SDK\Traits\FromArrayTrait;
use MercuryCash\SDK\Traits\ToArrayTrait;
use MercuryCash\SDK\Interfaces\RequestInterface;

class BillingTransaction implements RequestInterface
{
    use FromArrayTrait;
    use ToArrayTrait;

    /**
     * @var array
     */
    protected $client = null;

    /**
     * @var bool
     */
    protected $isBuyerAddressAdded = null;

    /**
     * @var string
     */
    protected $currency = null;

    /**
     * @var int
     */
    protected $due_date = null;

    /**
     * @var string
     */
    protected $invoice_number = null;

    /**
     * @var int
     */
    protected $amount = null;

    /**
     * @var bool
     */
    protected $processing_fee = null;

    /**
     * @var bool
     */
    protected $sendEmail = null;

    /**
     * @var array
     */
    protected $products = null;

    /**
     * @var int
     */
    protected $confirmations = null;

    /**
     * @var string
     */
    protected $cron_expression = null;

    /**
     * @var string
     */
    protected $end_date = null;

    /**
     * @return array
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param array $client
     * @return BillingTransaction
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return bool
     */
    public function isBuyerAddressAdded()
    {
        return $this->isBuyerAddressAdded;
    }

    /**
     * @param bool $isBuyerAddressAdded
     * @return BillingTransaction
     */
    public function setIsBuyerAddressAdded($isBuyerAddressAdded)
    {
        $this->isBuyerAddressAdded = $isBuyerAddressAdded;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return BillingTransaction
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return int
     */
    public function getDueDate()
    {
        return $this->due_date;
    }

    /**
     * @param int $due_date
     * @return BillingTransaction
     */
    public function setDueDate($due_date)
    {
        $this->due_date = $due_date;

        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceTransactionNumber()
    {
        return $this->invoice_number;
    }

    /**
     * @param string $invoice_number
     * @return BillingTransaction
     */
    public function BillingTransactionNumber($invoice_number)
    {
        $this->invoice_number = $invoice_number;

        return $this;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return BillingTransaction
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return bool
     */
    public function isProcessingFee()
    {
        return $this->processing_fee;
    }

    /**
     * @param bool $processing_fee
     * @return BillingTransaction
     */
    public function setProcessingFee($processing_fee)
    {
        $this->processing_fee = $processing_fee;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSendEmail()
    {
        return $this->sendEmail;
    }

    /**
     * @param bool $sendEmail
     * @return BillingTransaction
     */
    public function setSendEmail($sendEmail)
    {
        $this->sendEmail = $sendEmail;

        return $this;
    }

    /**
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param array $products
     * @return BillingTransaction
     */
    public function setProducts($products)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * @return int
     */
    public function getConfirmations()
    {
        return $this->confirmations;
    }

    /**
     * @param int $confirmations
     * @return BillingTransaction
     */
    public function setConfirmations($confirmations)
    {
        $this->confirmations = $confirmations;

        return $this;
    }

    /**
     * @return string
     */
    public function getCronExpression()
    {
        return $this->cron_expression;
    }

    /**
     * @param string $cron_expression
     * @return BillingTransaction
     */
    public function setCronExpression($cron_expression)
    {
        $this->cron_expression = $cron_expression;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * @param string $end_date
     * @return BillingTransaction
     */
    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;

        return $this;
    }
}
