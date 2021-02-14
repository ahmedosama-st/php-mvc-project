<?php

namespace SecTheater\Database\Concerns;

use SecTheater\Database\Managers\Contracts\DatabaseManager;

trait ConnectsTo
{
    public static function connect(DatabaseManager $manager)
    {
        return $manager->connect();
    }
}
