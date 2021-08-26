<?php

include_once './src/Support/helpers.php';

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

    public function test_it_flattens_an_array()
    {
        $nestedNumbers = [
            [1, [2, [3, [4, [5, [6]]]]]]
        ];
        $this->assertSame([1, 2, 3, 4, 5, 6], Arr::flatten($nestedNumbers));
    }

    public function test_it_flattens_without_removing_any_duplicates()
    {
        $nestedRepeatedNumbers = [
            [1, [1, [2, [2, 3]]]],
        ];

        $this->assertSame(
            [
                1, 1, 2, 2, 3
            ],
            Arr::flatten($nestedRepeatedNumbers)
        );
    }

    public function test_it_removes_an_item_from_an_array()
    {
        $users = [
            'ahmedosama' => [
                'username' => 'ahmedosama',
                'email' => 'ahmedosama@sectheater.io'
            ],
            'mahmoudkhaled' => [
                'username' => 'mahmoudkhaled',
                'email' => 'mahmoudkhaled@gmail.com'
            ]
        ];

        $this->assertArrayHasKey('mahmoudkhaled', $users);

        Arr::forget($users, 'mahmoudkhaled');

        $this->assertArrayNotHasKey('mahmoudkhaled', $users);
    }

    public function test_it_removes_multiple_items_from_an_array()
    {
        /* Ranking based on users' popularity */
        $ranks = [
            'first' => 118,
            'second' => 110,
            'third' => 107,
            'fourth' => 99,
            'fifth' => 85,
            'sixth' => 79,
            'seventh' => 78,
            'eighth' => 75
        ];

        $excludedKeys = ['sixth', 'seventh', 'eighth'];

        foreach ($excludedKeys as $key) {
            $this->assertArrayHasKey($key, $ranks);
        }

        Arr::forget($ranks, $excludedKeys);

        foreach ($excludedKeys as $key) {
            $this->assertArrayNotHasKey($key, $ranks);
        }
    }

    public function test_it_can_use_dot_as_a_delimiter_for_nested_array_keys()
    {
        $users = [
            'ahmedosama' => [
                'emails' => [
                    'primary' => 'ahmedosama@sectheater.io',
                    'secondary' => 'ahmedosama.sectheater@gmail.com'
                ]
            ]
        ];
        $this->assertArrayHasKey('primary', $users['ahmedosama']['emails']);

        Arr::forget($users, 'ahmedosama.emails.primary');

        $this->assertArrayNotHasKey('primary', $users['ahmedosama']['emails']);
    }

    public function test_it_gets_an_item_from_an_array_with_its_key_or_index()
    {
        $numbers = [1, 2, 'third' => 3, 4, 5];

        $this->assertEquals(2, Arr::get($numbers, 1));
        $this->assertEquals(3, Arr::get($numbers, 'third'));
        $this->assertEquals(5, Arr::get($numbers, 3));
    }

    public function test_it_gets_an_item_using_dot_separated_string_of_keys()
    {
        $config = [
            'db' => [
                'hosts' => [
                    'primary' => 'localhost',
                    'secondary' => '127.0.0.1'
                ]
            ]
        ];

        $this->assertEquals('localhost', Arr::get($config, 'db.hosts.primary'));
    }

    public function test_it_returns_the_array_if_getting_an_item_without_a_key()
    {
        $items = [1, 2, 3, 4, 5, 6];

        $this->assertSame($items, Arr::get($items, null));
    }

    public function test_it_returns_null_or_a_custom_default_value_if_key_does_not_exist()
    {
        $user = [
            'username' => 'ahmedosama',
            'password' => 'secret'
        ];

        $this->assertNull(Arr::get($user, 'email'));

        $this->assertEquals('nothing', Arr::get($user, 'email', 'nothing'));
    }

    public function test_it_returns_everything_in_an_array_except_given_keys()
    {
        $users = [
            'first' => ['email' => 'ahmedosama@sectheater.io'],
            'second' => ['email' => 'mahmoudkhaled@gmail.com'],
            'third' => ['email' => 'azzamismael@gmail.com']
        ];

        $this->assertSame(
            [
                'first' => ['email' => 'ahmedosama@sectheater.io']
            ],
            Arr::except($users, ['second', 'third'])
        );
    }

    public function test_it_requires_keys_to_be_given_to_check_if_an_array_has_them()
    {
        $items = ['first' => 1, 'second' => 2];

        $this->assertFalse(Arr::has($items, ''));
        $this->assertFalse(Arr::has($items, null));
        $this->assertFalse(Arr::has($items, []));
    }

    public function test_it_returns_false_if_given_key_or_keys_do_not_exist_in_an_array()
    {
        $items = ['first' => 1, 'second' => 2];

        $this->assertFalse(Arr::has($items, 'third'));
        $this->assertFalse(Arr::has($items, ['third', 'fourth']));
    }

    public function test_it_returns_true_if_items_exist_within_an_array()
    {
        $items = [
            'first' => 1,
            'second' => 2,
            3 => 'third',
            4 => 'fourth'
        ];

        $this->assertTrue(Arr::has($items, 'first'));
        $this->assertTrue(Arr::has($items, ['first', 'second']));
        $this->assertTrue(Arr::has($items, [3, 4]));
        $this->assertTrue(Arr::has($items, ['first', 'second', 3, 4]));
    }

    public function test_it_uses_dot_as_a_delimiter_for_keys_and_checks_for_items_existence()
    {
        $categories = [
            'technology' => [
                'laptops' => [
                    'dell' => [
                        'gtx' => [
                            'dell-g5',
                            'dell-g3'
                        ]
                    ]
                ]
            ]
        ];

        $this->assertTrue(Arr::has($categories, 'technology.laptops'));
        $this->assertTrue(Arr::has($categories, 'technology.laptops.dell'));
        $this->assertTrue(Arr::has($categories, 'technology.laptops.dell.gtx'));
        $this->assertTrue(Arr::has($categories, 'technology.laptops.dell.gtx.0'));
    }
}
