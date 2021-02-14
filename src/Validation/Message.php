<?php

namespace SecTheater\Validation;

class Message
{
    public static function generate($rule, $key)
    {
        return str_replace('%s', $key, $rule);
    }
}
