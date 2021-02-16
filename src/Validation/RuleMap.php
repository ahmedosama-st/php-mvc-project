<?php

namespace SecTheater\Validation;

use SecTheater\Validation\Rules\EmailRule;
use SecTheater\Validation\Rules\BetweenRule;
use SecTheater\Validation\Rules\AlphaNumRule;
use SecTheater\Validation\Rules\RequiredRule;
use SecTheater\Validation\Rules\ConfirmedRule;

class RuleMap
{
    protected static array $map = [
        'required' => RequiredRule::class,
        'email' => EmailRule::class,
        'alnum' => AlphaNumRule::class,
        'between' => BetweenRule::class,
        'confirmed' => ConfirmedRule::class
    ];

    public static function resolve($rule, $options)
    {
        return new static::$map[$rule](...$options);
    }
}
