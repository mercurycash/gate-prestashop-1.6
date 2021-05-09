<?php

namespace MercuryCash\SDK\Requests;

use MercuryCash\SDK\Traits\FromArrayTrait;
use MercuryCash\SDK\Traits\ToArrayTrait;
use MercuryCash\SDK\Interfaces\RequestInterface;

class CreateTransaction implements RequestInterface
{
    use FromArrayTrait;
    use ToArrayTrait;

    /**
     * @var string
     */
    protected $order_number = null;

    /**
     * @var string
     */
    protected $email = null;

    /**
     * @var string
     */
    protected $phone = null;

    /**
     * @var string
     */
    protected $crypto = null;

    /**
     * @var string
     */
    protected $fiat = null;

    /**
     * @var int
     */
    protected $amount = null;

    /**
     * @var int
     */
    protected $tip = null;

    /**
     * @var int
     */
    protected $confirmations = null;

    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->order_number;
    }

    /**
     * @param string $order_number
     * @return CreateTransaction
     */
    public function setOrderNumber($order_number)
    {
        $this->order_number = $order_number;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return CreateTransaction
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return CreateTransaction
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string
     */
    public function getCrypto()
    {
        return $this->crypto;
    }

    /**
     * @param string $crypto
     * @return CreateTransaction
     */
    public function setCrypto($crypto)
    {
        $this->crypto = $crypto;

        return $this;
    }

    /**
     * @return string
     */
    public function getFiat()
    {
        return $this->fiat;
    }

    /**
     * @param string $fiat
     * @return CreateTransaction
     */
    public function setFiat($fiat)
    {
        $this->fiat = $fiat;

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
     * @return CreateTransaction
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return int
     */
    public function getTip()
    {
        return $this->tip;
    }

    /**
     * @param int $tip
     * @return CreateTransaction
     */
    public function setTip($tip)
    {
        $this->tip = $tip;

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
     * @return CreateTransaction
     */
    public function setConfirmations($confirmations)
    {
        $this->confirmations = $confirmations;

        return $this;
    }
}
