<?php

use SecTheater\View\View;
use SecTheater\Application;
use SecTheater\Http\Request;
use SecTheater\Support\Hash;
use SecTheater\Validation\Validator;

if (!function_exists('env')) {
    function env($key, $default = null)
    {
        return $_ENV[$key] ?: $default;
    }
}

if (!function_exists('base_path')) {
    function base_path()
    {
        return dirname(__DIR__) . '/../';
    }
}

if (!function_exists('class_basename')) {
    function class_basename($class)
    {
        $class = is_object($class) ? get_class($class) : $class;

        return basename(str_replace('\\', '/', $class));
    }
}

if (!function_exists('view_path')) {
    function view_path()
    {
        return  base_path() . 'views/';
    }
}

if (!function_exists('value')) {
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
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
    function request($key = null)
    {
        $instance = new Request;

        if (!$instance) {
            return new Request;
        }

        if ($key) {
            if (is_string($key)) {
                return $instance->get($key);
            }

            if (is_array($key)) {
                return $instance->only($key);
            }
        }

        return $instance;
    }
}

if (!function_exists('validator')) {
    function validator()
    {
        return (new Validator());
    }
}

if (!function_exists('bcrypt')) {
    function bcrypt($data)
    {
        return Hash::make($data);
    }
}

if (!function_exists('database_path')) {
    function database_path()
    {
        return base_path() . 'database/';
    }
}
