<?php

namespace MercuryCash\SDK\Interfaces;

interface ResponseInterface
{
    /**
     * ResponseInterface constructor.
     * @param array $data
     */
    public function __construct($data);

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray($data);

    /**
     * @return array
     */
    public function toArray();
}
