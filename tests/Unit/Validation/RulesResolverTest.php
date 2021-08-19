<?php

use PHPUnit\Framework\TestCase;
use SecTheater\Validation\RulesResolver;
use SecTheater\Validation\Rules\RequiredRule;
use SecTheater\Validation\Rules\Contract\Rule;

class RulesResolverTest extends TestCase
{
    public function test_it_gets_rules_from_a_string()
    {
        $stringToMap = 'required';

        $instance = RulesResolver::getRuleFromString($stringToMap);

        $this->assertInstanceOf(RequiredRule::class, $instance);
    }

    public function test_it_makes_an_array_of_rules_out_of_piped_string()
    {
        $rules = 'required|alnum';

        $instances = RulesResolver::make($rules);

        foreach ($instances as $instance) {
            $this->assertInstanceOf(Rule::class, $instance);
        }
    }

    public function test_it_resolves_array_of_strings_to_array_of_rules()
    {
        $rules = ['alnum', 'required'];

        $instances = RulesResolver::make($rules);

        foreach ($instances as $instance) {
            $this->assertInstanceOf(Rule::class, $instance);
        }
    }
}
