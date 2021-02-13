<?php

namespace Acme\Http;

use Acme\Support\Arr;

class Request
{
    public function __construct($keys = null)
    {
        if (is_array($keys)) {
            return Arr::only($keys);
        }

        if (is_string($keys)) {
            return $this->get($keys);
        }
    }

    public function path()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        return str_contains($path, '?') ? explode('?', $path)[0] : $path;
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function all()
    {
        return $_REQUEST;
    }

    public function get($key)
    {
        return Arr::get($key);
    }

    public function only($keys)
    {
        return Arr::only($keys);
    }
}
