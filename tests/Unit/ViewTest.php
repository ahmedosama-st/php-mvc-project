<?php

use Dotenv\Dotenv;
use SecTheater\View\View;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    protected View $view;

    protected function setUp(): void
    {
        require_once './src/Support/helpers.php';
        $this->view = new View();

        $dotenv = Dotenv::createImmutable(base_path());
        $dotenv->load();
    }

    protected function getNonAccessibleMethod(string $name)
    {
        $reflection = new ReflectionClass($this->view);

        $method = $reflection->getMethod($name);

        if ($method->isPrivate() || $method->isProtected()) {
            $method->setAccessible(true);
        }

        return $method;
    }

    public function test_it_contains_content_placeholder_in_base_content_file()
    {
        $this->assertStringContainsStringIgnoringCase(
            '{{content}}',
            $this->getNonAccessibleMethod('getBaseContent')->invoke($this->view)
        );
    }

    public function test_it_has_app_name_from_env_as_title()
    {
        $this->assertStringContainsStringIgnoringCase(
            env('APP_NAME'),
            $this->getNonAccessibleMethod('getBaseContent')->invoke($this->view)
        );
    }

    public function test_it_replaces_content_placeholder_with_view_content()
    {
        $this->assertStringNotContainsStringIgnoringCase(
            '{{content}}',
            View::make('home')
        );
    }

    public function test_it_has_env_app_name_as_title_in_the_replaced_view_content()
    {
        $this->assertStringContainsStringIgnoringCase(
            env('APP_NAME'),
            View::make('home')
        );
    }
}
