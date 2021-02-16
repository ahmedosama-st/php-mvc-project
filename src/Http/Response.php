<?php

namespace SecTheater\Http;

class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function back()
    {
        header('Location:' . $_SERVER['HTTP_REFERER']);

        return $this;
    }

    public function with()
    {
    }

    public function withErrors($data)
    {
    }

    public function withSuccess($data)
    {
    }
}
