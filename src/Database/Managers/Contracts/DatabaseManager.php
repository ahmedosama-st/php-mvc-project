<?php

namespace SecTheater\Database\Managers\Contracts;

interface DatabaseManager
{
    public function connect(): \PDO;
    public function raw(string $query);
    public function query(string $query);
    public function create(mixed $data);
    public function read(int|string $filter);
    public function update(int|string $clause, mixed $data);
    public function delete(int|string $clause);
}
