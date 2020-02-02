<?php

namespace App\Traits;

trait HandleToJson
{
    public function jsonSerialize(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    public function offsetExists($offset)
    {
        return !empty($this->$offset);
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset($offset)
    {
    }
}
