<?php

namespace SecTheater\Database\Grammars;

use App\Models\Model;

class MySQLGrammar
{
    public static function build(string $type, mixed $data)
    {
        return match($type) {
            'INSERT' => static::buildInsertQuery($data),
            'UPDATE' => static::buildUpdateQuery($data),
            'SELECT' => static::buildSelectQuery($data),
        };
    }

    protected static function buildUpdateQuery($data): string
    {
        $query = '';

        return $query;
    }

    protected static function buildInsertQuery($keys)
    {
        $values = '';
        for ($i = 1; $i <= count($keys); $i++) {
            $values .= '?';
            if ($i < count($keys))
                $values .= ', ';
        }

        $query = "INSERT INTO " . Model::getTableName() . " (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

        return $query;
    }

    protected static function buildSelectQuery($data)
    {
        //
    }

    protected static function buildRawQuery($query)
    {
        //
    }
}
