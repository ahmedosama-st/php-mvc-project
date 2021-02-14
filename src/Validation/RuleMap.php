<?php

namespace SecTheater\Validation;

use SecTheater\Validation\Rules\AlphaNumRule;
use SecTheater\Validation\Rules\EmailRule;
use SecTheater\Validation\Rules\RequiredRule;

class RuleMap
{
    protected static array $map = [
        'required' => RequiredRule::class,
        'email' => EmailRule::class,
        'alnum' => AlphaNumRule::class
    ];

    public static function resolve($rules, $options = [])
    {
        return (is_string($rules) && str_contains($rules, '|')) ? static::build(explode('|', $rules), $options) : static::build($rules, $options);
    }

    protected static function build($rules, $options)
    {
        return array_map(function ($rule) use ($options) {
            if (is_string($rule)) {
                return new static::$map[$rule](...$options);
            }

            return $rule;
        }, $rules);
    }
}
