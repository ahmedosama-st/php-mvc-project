<?php

namespace Acme\Validation\Rules;

use Acme\Validation\Rules\Contract\Rule;

class RequiredRule implements Rule
{
    public function apply($value)
    {
        return !empty($value);
    }

    public function __toString()
    {
        return '%s is required and cannot be empty';
    }
}
