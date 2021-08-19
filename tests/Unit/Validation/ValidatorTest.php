<?php

use PHPUnit\Framework\TestCase;
use SecTheater\Validation\Validator;

class ValidatorTest extends TestCase
{
    public function test_it_validates_given_data()
    {
        $validator = new Validator();

        $validator->setRules([
            'name' => 'required|alnum|between:8,32',
            'username' => 'required|alnum|between:8,32',
        ]);

        $validator->make([
            'name' => 'ahmed osama',
            'username' => 'ahmedosama_st'
        ]);

		$this->assertTrue($validator->passes());
    }
}
