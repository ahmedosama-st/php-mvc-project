<?php

namespace SecTheater\Support;

class Config implements \ArrayAccess
{
    protected array $configurations = [];

    public function __construct(array $configurations)
    {
        $this->configurations = $configurations;
    }

    public function get($key)
    {
        return Arr::get($this->configurations, $key);
    }

    public function getMany($keys)
    {
        $array = [];

        foreach ($keys as $key) {
            $array[] = $this->get($key);
        }

        return $array;
    }

    public function set($key, $value)
    {
        Arr::set($this->configurations, $key, $value);
    }

    public function exists($key)
    {
        return Arr::exists($this->configurations, $key);
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
