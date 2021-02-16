<?php

namespace SecTheater\Database\Managers;

use App\Models\Model;
use SecTheater\Database\Grammars\MySQLGrammar;
use SecTheater\Database\Managers\Contracts\DatabaseManager;

class MySQLManager implements DatabaseManager
{
    protected static $instance;

    public function connect(): \PDO
    {
        if (!self::$instance) {
            self::$instance = new \PDO(env('DB_DRIVER') . ':host=' . env('DB_HOST') . ';dbname=' . env('DB_DATABASE'), env('DB_USERNAME'), env('DB_PASSWORD'));
        }

        return self::$instance;
    }

    public function query($query, $values)
    {
        $stmt = self::$instance->prepare($query);
        for ($i = 1; $i <= count($values); $i++) {
            $stmt->bindValue($i, $values[$i - 1]);
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create(mixed $data)
    {
        $query = MySQLGrammar::buildInsertQuery(array_keys($data));

        $stmt = self::$instance->prepare($query);

        for ($i = 1; $i <= count($values = array_values($data)); $i++) {
            $stmt->bindValue($i, $values[$i - 1]);
        }

        return $stmt->execute();
    }

    public function read($columns = '*', $filter = null)
    {
        $query = MySQLGrammar::buildSelectQuery($columns, $filter);

        $stmt = self::$instance->prepare($query);

        if ($filter) {
            $stmt->bindValue(1, $filter[2]);
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, Model::getModel());
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
