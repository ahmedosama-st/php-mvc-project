<?php

use PHPUnit\Framework\TestCase;
use SecTheater\Validation\Rules\UniqueRule;
use SecTheater\Validation\Rules\Contract\Rule;

class UniqueRuleTest extends TestCase
{
    public function test_it_implements_the_rule_interface()
    {
        $rule = new UniqueRule('TestTable', 'TestColumn');

        $this->assertInstanceOf(Rule::class, $rule);
    }

    public function test_it_fails_if_table_or_column_is_not_found()
    {
        $rule = new UniqueRule('TestTable', 'TestColumn');

        $this->assertFalse(
            $rule->apply('username', 'lorem ipsum')
        );
    }
}
