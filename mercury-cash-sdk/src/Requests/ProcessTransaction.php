<?php

namespace MercuryCash\SDK\Requests;

use MercuryCash\SDK\Traits\FromArrayTrait;
use MercuryCash\SDK\Traits\ToArrayTrait;
use MercuryCash\SDK\Interfaces\RequestInterface;

class ProcessTransaction implements RequestInterface
{
    use FromArrayTrait;
    use ToArrayTrait;

    /**
     * @var string
     */
    protected $uuid = null;

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }
}
