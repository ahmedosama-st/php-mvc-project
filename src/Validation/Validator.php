<?php

namespace Acme\Validation;

class Validator
{
    protected array $data = [];

    protected array $errors = [];

    public function make($data)
    {
        $this->data = $data;

        $this->validate($data);
    }

    protected function validate($data)
    {
        var_dump($data);
    }

    public function passes()
    {
        return  empty($this->errors());
    }

    public function errors()
    {
        return $this->errors;
    }
}
