<?php

namespace SecTheater\Database\Grammars;

use App\Models\Model;

class MySQLGrammar
{
    public static function buildUpdateQuery($data): string
    {
        $query = '';

        return $query;
    }

    public static function buildInsertQuery($keys)
    {
        $values = '';
        for ($i = 1; $i <= count($keys); $i++) {
            $values .= '?';
            if ($i < count($keys)) {
                $values .= ', ';
            }
        }

        $query = 'INSERT INTO ' . Model::getTableName() . ' (`' . implode('`, `', $keys) . "`) VALUES ({$values})";

        return $query;
    }

    public static function buildSelectQuery($columns, $filter)
    {
        if (is_array($columns)) {
            $columns = implode(', ', $columns);
        }

        $query = "SELECT {$columns} FROM " . Model::getTableName();

        if ($filter) {
            $query .= " WHERE {$filter[0]} {$filter[1]} ?";
        }

        return $query;
    }

    public static function buildRawQuery($query)
    {
        //
    }
}
