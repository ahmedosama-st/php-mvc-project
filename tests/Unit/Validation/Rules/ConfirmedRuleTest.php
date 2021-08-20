<?php

use PHPUnit\Framework\TestCase;
use SecTheater\Validation\Rules\ConfirmedRule;
use SecTheater\Validation\Rules\Contract\Rule;

class ConfirmedRuleTest extends TestCase
{
	public function test_it_implements_the_rule_interface()
	{
		$rule  = new ConfirmedRule();

		$this->assertInstanceOf(Rule::class ,$rule);
	}

	public function test_it_fails_if_two_subjects_are_not_matching()
	{
		$subjectOne = "secret123";

		$subjectTwo = "secret321";

		$rule = new ConfirmedRule();

		$this->assertFalse(
			$rule->apply("password", $subjectOne, [
				'password' => $subjectOne,
				'password_confirmation' => $subjectTwo
			])
		);
	}

	public function test_it_passes_if_two_subjects_are_matching()
	{
		$subjectOne = "secret123";

		$subjectTwo = "secret123";

		$rule = new ConfirmedRule();

		$this->assertTrue(
			$rule->apply("password", $subjectOne, [
				'password' => $subjectOne,
				'password_confirmation' => $subjectTwo
			])
		);
	}
}