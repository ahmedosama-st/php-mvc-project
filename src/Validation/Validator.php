<?php

namespace Acme\Validation;

class Validator
{
    protected static array $data = [];

    public static function make($data)
    {
        self::$data = $data;

        self::validate($data);
    }

    protected static function validate($data)
    {
        var_dump($data);
    }

    protected static function passes()
    {
        return ;
    }
}
