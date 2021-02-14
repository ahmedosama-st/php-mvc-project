<?php

namespace SecTheater\Support;

class Config implements \ArrayAccess
{
    public static function get($key)
    {
    }

    public static function getMany()
    {
    }

    public static function set($key, $value)
    {
    }

    public function offsetGet($offset)
    {
        $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        $this->set($offset, null);
    }

    public function offsetExists($offset)
    {
        $this->exists($offset);
    }
}
