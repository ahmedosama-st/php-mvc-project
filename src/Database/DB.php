<?php

namespace SecTheater\Database;

use SecTheater\Database\Concerns\ConnectsTo;
use SecTheater\Database\Managers\Contracts\DatabaseManager;

class DB
{
    use ConnectsTo;

    protected \PDO $capsule;
    protected DatabaseManager $manager;

    public function __construct(DatabaseManager $manager)
    {
        $this->manager = $manager;
    }

    public function init()
    {
        $this->capsule = ConnectsTo::connect($this->manager);
    }

    public function raw(string $query)
    {
        $this->manager->query($query);
    }

    public function create(array $data)
    {
        $this->manager->create($data);
    }
}
