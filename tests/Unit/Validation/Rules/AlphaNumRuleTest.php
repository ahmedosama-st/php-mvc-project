<?php

use PHPUnit\Framework\TestCase;
use SecTheater\Validation\Rules\AlphaNumRule;
use SecTheater\Validation\Rules\Contract\Rule;

class AlphaNumRuleTest extends TestCase
{
    public function test_it_implements_the_rule_interface()
    {
        $rule = new AlphaNumRule();

        $this->assertInstanceOf(Rule::class, $rule);
    }

    public function test_it_fails_if_given_subject_contains_symbols()
    {
        $subject = 'ahmed@osama';

        $rule =new AlphaNumRule();

        $this->assertFalse(
            (bool) $rule->apply('testField', $subject)
        );
    }

    public function test_it_passes_if_given_alpha_numerical_subjects()
    {
        $subjects = [
            'ahmedosama',
            'ahmed_osama',
            'ahmedosama-st',
            'secret123',
            '123456789',
            'a1b2c3'
        ];

        $rule = new AlphaNumRule();

        foreach ($subjects as $subject) {
            $this->assertTrue(
                (bool) $rule->apply('testField', $subject)
            );
        }
    }
}
