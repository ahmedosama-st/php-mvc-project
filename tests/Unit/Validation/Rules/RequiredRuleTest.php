<?php

use PHPUnit\Framework\TestCase;
use SecTheater\Validation\Rules\RequiredRule;
use SecTheater\Validation\Rules\Contract\Rule;

class RequiredRuleTest extends TestCase
{
    public function test_it_implements_the_rule_interface()
    {
        $rule = new RequiredRule();

        $this->assertInstanceOf(Rule::class, $rule);
    }

    public function test_it_fails_if_given_input_is_empty()
    {
        $username = '';

        $rule = new RequiredRule();

        $this->assertFalse(
            $rule->apply(
                'username',
                $username
            )
        );
    }

    public function test_it_passes_if_given_input_has_a_value()
    {
        $username = 'ahmedosama-st';

        $rule = new RequiredRule();

        $this->assertTrue(
            $rule->apply(
                'username',
                $username
            )
        );
    }
}
