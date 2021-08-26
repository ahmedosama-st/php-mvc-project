<?php

use PHPUnit\Framework\TestCase;
use SecTheater\Validation\Message;

class MessageTest extends TestCase
{
    public function test_it_replaces_rule_name_within_string()
    {
        $this->assertEquals(Message::generate('%s is required and cannot be empty', 'username'), 'username is required and cannot be empty');
    }
}
