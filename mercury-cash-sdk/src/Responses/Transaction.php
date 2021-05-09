<?php

namespace MercuryCash\SDK\Responses;

use MercuryCash\SDK\Traits\FromArrayTrait;
use MercuryCash\SDK\Traits\ToArrayTrait;
use MercuryCash\SDK\Interfaces\ResponseInterface;

class Transaction implements ResponseInterface
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
    protected $address = null;

    /**
     * @var float
     */
    protected $cryptoAmount = null;

    /**
     * @var float
     */
    protected $fiatAmount = null;

    /**
     * @var int
     */
    protected $tip = 1;

    /**
     * @var float
     */
    protected $rate = null;

    /**
     * @var float
     */
    protected $fee = null;

    /**
     * @var string
     */
    protected $fiatIsoCode = null;

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return Transaction
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Transaction
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return float
     */
    public function getCryptoAmount()
    {
        return $this->cryptoAmount;
    }

    /**
     * @param float $cryptoAmount
     * @return Transaction
     */
    public function setCryptoAmount($cryptoAmount)
    {
        $this->cryptoAmount = $cryptoAmount;

        return $this;
    }

    /**
     * @return float
     */
    public function getFiatAmount()
    {
        return $this->fiatAmount;
    }

    /**
     * @param float $fiatAmount
     * @return Transaction
     */
    public function setFiatAmount($fiatAmount)
    {
        $this->fiatAmount = $fiatAmount;

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
     * @return Transaction
     */
    public function setTip($tip)
    {
        $this->tip = $tip;

        return $this;
    }

    /**
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     * @return Transaction
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * @return float
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @param float $fee
     * @return Transaction
     */
    public function setFee($fee)
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * @return string
     */
    public function getFiatIsoCode()
    {
        return $this->fiatIsoCode;
    }

    /**
     * @param string $fiatIsoCode
     * @return Transaction
     */
    public function setFiatIsoCode($fiatIsoCode)
    {
        $this->fiatIsoCode = $fiatIsoCode;

        return $this;
    }
}
