<?php

use PHPUnit\Framework\TestCase;
use SecTheater\Validation\Rules\BetweenRule;
use SecTheater\Validation\Rules\Contract\Rule;

class BetweenRuleTest extends TestCase
{
    public function test_it_implements_the_rule_interface()
    {
        $rule = new BetweenRule(0, 1);

        $this->assertInstanceOf(Rule::class, $rule);
    }

    public function test_it_fails_if_upper_bound_is_violated()
    {
        $subject = 'hello world';

        $rule = new BetweenRule(3, 5);

        $this->assertFalse(
            (bool) $rule->apply('TestField', $subject)
        );
    }

    public function test_it_fails_if_lower_bound_is_violated()
    {
        $subject = 'hello world';

        $rule = new BetweenRule(15, 20);

        $this->assertFalse(
            $rule->apply('TestField', $subject)
        );
    }

    public function test_it_passes_if_subject_is_in_between_bounds()
    {
        $subject = 'hello';

        $rule = new BetweenRule(1, 5);

        $this->assertTrue(
            $rule->apply('TestField', $subject)
        );
    }
}
