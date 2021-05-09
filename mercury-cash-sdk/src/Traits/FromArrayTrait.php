<?php

namespace MercuryCash\SDK\Traits;

trait FromArrayTrait
{
    /**
     * FromArrayTrait constructor.
     * @param array $data
     */
    public function __construct($data)
    {
        foreach ($data as $key => $value) {
//            $method = 'set' . ucfirst($key);
//            $this->$method($value);

            $this->$key = $value;
        }
    }

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray($data)
    {
        return new static($data);
    }
}
