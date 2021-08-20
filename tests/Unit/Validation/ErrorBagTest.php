<?php

use PHPUnit\Framework\TestCase;
use SecTheater\Validation\Message;
use SecTheater\Validation\ErrorBag;

class ErrorBagTest extends TestCase
{
    public function test_it_adds_error_message_for_a_field()
    {
        $bag = new ErrorBag();

        $bag->add('username', 'Test message for username');

        $this->assertArrayHasKey('username', $bag->errors);
    }

    public function test_it_can_use_message_api_for_adding_errors()
    {
        $bag = new ErrorBag();

        $bag->add('username', Message::generate('%s is added', 'username'));

        $this->assertArrayHasKey('username', $bag->errors);
        $this->assertEquals('username is added', $bag->errors['username'][0]);
    }

    public function test_it_adds_multiple_error_messages_for_the_same_field()
    {
        $bag = new ErrorBag();

        $bag->add('username', 'First');
        $bag->add('username', 'Second');
        $bag->add('username', 'Third');

        $this->assertCount(3, $bag->errors['username']);
    }
}
