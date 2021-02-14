<?php

namespace Acme\Validation\Rules\Contract;

interface Rule
{
    public function apply($value);

    public function __toString();
}
