<?php

namespace SecTheater\Database;

use SecTheater\Database\Concerns\ConnectsTo;
use SecTheater\Database\Managers\Contracts\DatabaseManager;

class DB
{
    use ConnectsTo;

    protected \PDO $capsule;
    protected ?DatabaseManager $manager;

    public function __construct(DatabaseManager $manager)
    {
        $this->manager = $manager;
    }

    public function init()
    {
        $this->capsule = ConnectsTo::connect($this->manager);
    }

    protected function raw(string $query, $value)
    {
        // var_dump($query);
        return $this->manager->query($query, $value);
    }

    protected function create(array $data)
    {
        return $this->manager->create($data);
    }

    protected function read($columns = '*', $filter = null)
    {
        return $this->manager->read($columns, $filter);
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        }
    }
}
