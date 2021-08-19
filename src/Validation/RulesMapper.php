<?php

namespace SecTheater\Validation;

use SecTheater\Validation\Rules\MaxRule;
use SecTheater\Validation\Rules\EmailRule;
use SecTheater\Validation\Rules\UniqueRule;
use SecTheater\Validation\Rules\BetweenRule;
use SecTheater\Validation\Rules\AlphaNumRule;
use SecTheater\Validation\Rules\RequiredRule;
use SecTheater\Validation\Rules\ConfirmedRule;

trait RulesMapper
{
    protected static array $map = [
        'required' => RequiredRule::class,
        'alnum' => AlphaNumRule::class,
        'max' => MaxRule::class,
        'between' => BetweenRule::class,
        'email' => EmailRule::class,
        'confirmed' => ConfirmedRule::class,
        'unique' => UniqueRule::class,
    ];

    public static function resolve(string $rule, $options)
    {
        return new static::$map[$rule](...$options);
    }
}
