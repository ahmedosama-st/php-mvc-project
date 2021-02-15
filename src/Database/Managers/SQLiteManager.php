<?php

namespace SecTheater\Database\Managers;

use SecTheater\Database\Managers\Contracts\DatabaseManager;

class SQLiteManager implements DatabaseManager
{
    protected static $instance;

    public function connect(): \PDO
    {
        if (!self::$instance) {
            self::$instance = new \PDO(env('DB_DRIVER') . ':' . database_path() . 'database.sqlite');
        }

        return self::$instance;
    }

    public function raw(string $query)
    {
        throw new \Exception('Method raw() is not implemented.');
    }

    public function query(string $query)
    {
        throw new \Exception('Method query() is not implemented.');
    }

    public function create(mixed $data)
    {
        throw new \Exception('Method create() is not implemented.');
    }

    public function read($columns = '*', $filter = null)
    {
        throw new \Exception('Method read() is not implemented.');
    }

    public function update($clause, mixed $data)
    {
        throw new \Exception('Method update() is not implemented.');
    }

    public function delete($clause)
    {
        throw new \Exception('Method delete() is not implemented.');
    }
}
