<?php

use SecTheater\Support\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    protected Config $config;

    protected function setUp(): void
    {
        $this->config = new Config($this->data());
    }

    protected function data()
    {
        return [
            'database' => [
                'host' => 'localhost',
                'username' => 'ahmedosama',
                'password' => 'secret',
                'db_name' => 'playground'
            ],
            'mail' => [
                'default' => 'smtp',

                'smtp' => [
                    'transport' => 'smtp',
                    'host' => 'mailhog',
                    'port' => 1025
                ],
            ],
            'logging' => [
                'default' => 'stack'
            ]
        ];
    }

    public function test_it_accepts_iterable_data_from_a_generator()
    {
        $config = new Config($this->itemsGenerator());

        $this->assertSame($this->data(), $config->all());
    }

    protected function itemsGenerator()
    {
        foreach ($this->data() as $key => $item) {
            yield $key => $item;
        }
    }

    public function test_it_implements_the_array_access_class()
    {
        $this->assertInstanceOf(\ArrayAccess::class, $this->config);
    }

    public function test_it_adds_items_correctly()
    {
        $this->assertSame($this->data(), $this->config->all());
    }

    public function test_it_gets_an_item_correctly()
    {
        $this->assertEquals('localhost', $this->config->get('database.host'));
    }

    public function test_it_gets_multiple_items()
    {
        $this->assertSame(
            [
                'database.host' => 'localhost',
                'logging.default' => 'stack',
                'mail.default' => 'smtp'
            ],
            $this->config->getMany(['database.host', 'logging.default', 'mail.default'])
        );
    }

    public function test_it_delegates_fetching_many_items_to_get_many_method_from_get_method()
    {
        $this->assertSame(
            [
                'database.host' => 'localhost',
                'logging.default' => 'stack',
                'mail.default' => 'smtp'
            ],
            $this->config->get(['database.host', 'logging.default', 'mail.default'])
        );
    }

    public function test_it_sets_an_item_or_multiple_items()
    {
        $this->assertEquals('localhost', $this->config->get('database.host'));

        $this->config->set('database.host', '127.0.0.1');

        $this->assertEquals('127.0.0.1', $this->config->get('database.host'));
    }

    public function test_it_pushes_a_new_item_to_the_array_and_gets_it_correctly()
    {
        require_once './src/Support/helpers.php';

        $this->assertArrayNotHasKey('payment', $this->config->all());

        $this->config->push('payment.methods', [
            'default' => 'stripe',
            'another' => 'paypal'
        ]);

        $this->assertArrayHasKey('payment', $this->config->all());

        $this->assertEquals('stripe', $this->config->get('payment.methods.default'));
    }

    public function test_it_pushes_an_item_to_an_existing_array_within_config_and_gets_it_correctly()
    {
        require_once './src/Support/helpers.php';

        $this->assertArrayHasKey('database', $this->config->all());
        $this->assertArrayNotHasKey('port', $this->config->get('database'));

        $this->config->push('database.port', 8000);

        $this->assertArrayHasKey('port', $this->config->get('database'));

        $this->assertEquals(8000, $this->config->get('database.port'));
    }

    public function test_it_checks_for_top_level_item_existence()
    {
        $this->assertFalse($this->config->exists('payment'));
        $this->assertTrue($this->config->exists('database'));
    }

    public function test_it_checks_if_a_config_has_an_item()
    {
        $this->assertTrue($this->config->has('database'));
        $this->assertTrue($this->config->has('database.host'));

        $this->assertFalse($this->config->has('payment'));
        $this->assertFalse($this->config->has('database.localhost'));
    }
}
