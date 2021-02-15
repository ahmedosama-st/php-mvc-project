<?php

namespace App\Models;

use SecTheater\Support\Str;

abstract class Model
{
    protected static $instance;

    public static function create(array $attributes)
    {
        self::$instance = static::class;

        return app()->db->create($attributes);
    }

    public static function getTableName()
    {
        return Str::lower(Str::plural(class_basename(self::$instance)));
    }
}
