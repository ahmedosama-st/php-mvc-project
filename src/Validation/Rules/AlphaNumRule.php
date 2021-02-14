<?php

namespace Acme\Validation\Rules;

use Acme\Validation\Rules\Contract\Rule;

class AlphaNumRule implements Rule
{
    public function apply($value)
    {
        return preg_match('/^[a-zA-Z0-9]+/', $value);
    }

    public function __toString()
    {
        return '%s must be alpha numeric only';
    }
}
