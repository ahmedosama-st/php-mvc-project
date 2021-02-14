<?php

namespace Acme\Validation;

class Validator
{
    protected array $data = [];

    protected array $errors = [];

    protected array $rules = [];

    public function make($data)
    {
        $this->data = $data;

        $this->applyRules();
    }

    public function setRules(array $rules)
    {
        $this->rules = $rules;
    }

    protected function applyRules()
    {
        foreach ($this->rules as $key => $rules) {
            foreach ($rules as $rule) {
                if (!call_user_func([$rule, 'apply'], $this->data[$key])) {
                    $this->errors[$key][] = Message::generate($rule, $key);
                }
            }
        }
    }

    public function passes()
    {
        return empty($this->errors());
    }

    public function errors()
    {
        return $this->errors;
    }
}
