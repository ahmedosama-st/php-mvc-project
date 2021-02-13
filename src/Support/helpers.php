<?php

use Acme\View\View;
use Acme\Application;
use Acme\Http\Request;

if (!function_exists('env')) {
    function env($key)
    {
        return $_ENV[$key];
    }
}

if (!function_exists('base_path')) {
    function base_path()
    {
        return dirname(__DIR__) . '/../';
    }
}

if (!function_exists('view_path')) {
    function view_path()
    {
        return  base_path() . 'views/';
    }
}

if (!function_exists('public_path')) {
    function public_path()
    {
        return base_path() . 'public/';
    }
}

if (!function_exists('view')) {
    function view($view, $params = [])
    {
        View::make($view, $params);
    }
}

if (!function_exists('app')) {
    function app()
    {
        $instance = new Application;

        if (!$instance) {
            return new Application;
        }
        return $instance;
    }
}

if (!function_exists('request')) {
    function request()
    {
        $instance = new Request;

        if (!$instance) {
            return new Request;
        }

        return $instance;
    }
}
