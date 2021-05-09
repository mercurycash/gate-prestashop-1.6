<?php

namespace MercuryCash\SDK\Responses;

use MercuryCash\SDK\Interfaces\ResponseInterface;
use MercuryCash\SDK\Traits\FromArrayTrait;
use MercuryCash\SDK\Traits\ToArrayTrait;

class Status implements ResponseInterface
{
    use FromArrayTrait;
    use ToArrayTrait;

    /**
     * @var string
     */
    protected $uuid = null;

    /**
     * @var string
     */
    protected $fromAddress = null;

    /**
     * @var int
     */
    protected $amount = null;

    /**
     * @var string
     */
    protected $currency = null;

    /**
     * @var string
     */
    protected $transactionFee = null;

    /**
     * @var string
     */
    protected $networkFee = null;

    /**
     * @var string
     */
    protected $user = null;

    /**
     * @var string
     */
    protected $status = null;

    /**
     * @var string
     */
    protected $confirmations = null;

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return Status
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromAddress()
    {
        return $this->fromAddress;
    }

    /**
     * @param string $fromAddress
     * @return Status
     */
    public function setFromAddress($fromAddress)
    {
        $this->fromAddress = $fromAddress;

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
     * @return Status
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

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
     *
     * @return Status
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionFee()
    {
        return $this->transactionFee;
    }

    /**
     * @param string $transactionFee
     * @return Status
     */
    public function setTransactionFee($transactionFee)
    {
        $this->transactionFee = $transactionFee;

        return $this;
    }

    /**
     * @return string
     */
    public function getNetworkFee()
    {
        return $this->networkFee;
    }

    /**
     * @param string $networkFee
     * @return Status
     */
    public function setNetworkFee($networkFee)
    {
        $this->networkFee = $networkFee;

        return $this;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     * 
     * @return Status
     */
    public function setUser($user)
    {
        $this->user = $user;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Status
     */
    public function setStatus($status)
    {
        $this->status = $status;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getConfirmations()
    {
        return $this->confirmations;
    }

    /**
     * @param string $confirmations
     *
     * @return \MercuryCash\SDK\Responses\Status
     */
    public function setConfirmations($confirmations)
    {
        $this->confirmations = $confirmations;

        return $this;
    }


}
