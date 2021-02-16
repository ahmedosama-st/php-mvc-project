<?php

namespace SecTheater\Validation;

class Validator
{
    protected array $data = [];

    protected array $rules = [];

    protected ErrorBag $errorBag;

    public function make($data)
    {
        $this->data = $data;
        $this->errorBag = new ErrorBag;
        $this->applyRules();
    }

    public function setRules(array $rules)
    {
        $this->rules = $rules;
    }

    protected function applyRules()
    {
        foreach ($this->rules as $key => $rules) {
            foreach ($this->getResolvedRules($rules) as $rule) {
                if (!$rule->apply($this->data[$key])) {
                    $this->errorBag->add($key, Message::generate($rule, $key));
                }
            }
        }
    }

    protected function getResolvedRules($rules)
    {
        return RuleMap::resolve($rules);
    }

    public function passes()
    {
        return empty($this->errors());
    }

    public function errors($key = null)
    {
        return $key ? $this->errorBag->errors[$key] : $this->errorBag->errors;
    }
}
