<?php

class Test
{
    public function getTableName()
    {
        return static::class;
    }
}

class User extends Test
{
}

var_dump(User::getTableName());
