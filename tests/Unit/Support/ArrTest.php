<?php

use SecTheater\Support\Arr;
use PHPUnit\Framework\TestCase;

class ArrTest extends TestCase
{
    public function test_it_gets_the_wanted_kes_only_from_an_array()
    {
        $array = [
            'ahmed' => ['age' => 19],
            'mohamed' => ['age' => 29],
            'php' => ['version' => 8.0],
            'node' => ['version' => 'lts']
        ];

        $extracted = Arr::only($array, ['php', 'node']);

        $this->assertSame([
            'php' => ['version' => 8.0],
            'node' => ['version' => 'lts']
        ], $extracted);
    }

    public function test_it_checks_for_accessible_values()
    {
        $data = [
            'username' => 'ahmedosama_st',
            'emails' => [
                'primary' => 'ahmedosama@sectheater.io',
                'secondary' => 'ahmedosama.sectheater@gmail.com'
            ]
        ];

        $this->assertFalse(Arr::accessible('string'));
        $this->assertTrue(Arr::accessible($data['emails']));
    }

    public function test_it_checks_for_data_existence()
    {
        $data = [
            'username' => 'ahmedosama_st',
            'emails' => [
                'primary' => 'ahmedosama@sectheater.io',
                'secondary' => 'ahmedosama.sectheater@gmail.com'
            ]
        ];

        $this->assertFalse(Arr::exists($data, 'password'));
        $this->assertTrue(Arr::exists($data, 'username'));
    }

    public function test_it_modifies_an_item_with_its_key_or_index()
    {
        $data = [
            'ahmed_osama',
            'emails' => [
                'primary' => 'ahmedosama@sectheater.io',
                'secondary' => 'ahmedosama.sectheater@gmail.com'
            ]
        ];

        Arr::set($data, 0, 'mahmoud');
        $this->assertSame('mahmoud', $data[0]);

        Arr::set($data, 'emails.primary', 'anotheremail@example.com');
        $this->assertSame('anotheremail@example.com', $data['emails']['primary']);
    }

    public function test_it_sets_the_whole_array_to_be_the_value_if_key_is_not_given()
    {
        $array = [1, 2, 3, 4, 5];

        Arr::set($array, null, 'ahmed');

        $this->assertEquals('ahmed', $array);
    }

    public function test_it_adds_items_to_a_specific_array()
    {
        $array = ['ahmed', 'mahmoud', 'khaled'];

        $newArray = Arr::add($array, count($array), 'ismael');

        $this->assertEquals('ismael', end($newArray));
    }

    public function test_it_does_not_modify_items_when_adding_new_ones()
    {
        $array = ['username' => 'ahmed', 'password' => '123456'];

        $newArray = Arr::add($array, 'username', 'ahmedosama-st');

        $this->assertEquals('ahmed', $newArray['username']);
    }

    public function test_it_gets_the_first_item_of_an_array()
    {
        $array = ['first' => 1, 'second' => 2];

        $this->assertEquals(1, Arr::first($array));
    }

    public function test_it_returns_null_or_a_default_value_for_the_first_item_if_an_array_is_empty()
    {
        include_once './src/Support/helpers.php';

        $array  = [];

        $this->assertNull(Arr::first($array));

        $this->assertEquals('nothing', Arr::first($array, default: 'nothing'));
    }

    public function test_it_applies_callback_before_returning_the_first_item()
    {
        $array = [1, 2, 3, 4, 5, 6];

        $this->assertEquals(4, Arr::first($array, fn ($x) => $x * 4));
    }

    public function test_it_gets_the_last_item_of_an_array()
    {
        $array = ['first' => 1, 'second' => 2];

        $this->assertEquals(2, Arr::last($array));
    }

    public function test_it_returns_null_or_a_default_value_for_the_last_item_if_an_array_is_empty()
    {
        include_once './src/Support/helpers.php';

        $array  = [];

        $this->assertNull(Arr::last($array));

        $this->assertEquals('nothing', Arr::last($array, default: 'nothing'));
    }

    public function test_it_applies_callback_before_returning_the_last_item()
    {
        $array = [1, 2, 3, 4, 5, 6];

        $this->assertEquals(24, Arr::last($array, fn ($x) => $x * 4));
    }
}
