<?php

namespace SecTheater\Validation;

use SecTheater\Validation\Rules\Contract\Rule;

class Validator
{
    protected array $data = [];

    protected array $aliases = [];

    protected array $rules = [];

    protected ErrorBag $errorBag;

    public function make($data)
    {
        $this->data = $data;
        $this->errorBag = new ErrorBag;
        $this->validate();
    }

    public function setRules(array $rules)
    {
        $this->rules = $rules;
    }

    protected function validate()
    {
        foreach ($this->rules as $field => $rules) {
            foreach ($this->resolveRules($rules) as $rule) {
                $this->applyRule($field, $rule);
            }
        }
    }

    protected function applyRule($field, Rule $rule)
    {
        if (!$rule->apply($field, $this->getFieldValue($field), $this->data)) {
            $this->errorBag->add($field, Message::generate($rule, $this->alias($field)));
        }
    }

    protected function resolveRules(array|string $rules)
    {
        $rules = str_contains($rules, '|') ? explode('|', $rules) : $rules;


        return array_map(function ($rule) {
            if (is_string($rule)) {
                return $this->getRuleFromString($rule);
            }

            return $rule;
        }, $rules);
    }

    protected function getRuleFromString(string $rule)
    {
        return RuleMap::resolve(
            ($exploded = explode(':', $rule))[0],
            explode(',', end($exploded))
        );
    }

    protected function getFieldValue($field)
    {
        return $this->data[$field] ?? null;
    }

    public function passes()
    {
        return empty($this->errors());
    }

    public function errors($key = null)
    {
        return $key ? $this->errorBag->errors[$key] : $this->errorBag->errors;
    }

    public function alias($field)
    {
        return $this->aliases[$field] ?? $field;
    }

    public function setAliases(array $aliases)
    {
        $this->aliases = $aliases;
    }
}
