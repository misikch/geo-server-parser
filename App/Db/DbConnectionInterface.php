<?php

namespace App\Db;

interface DbConnectionInterface
{
    public function query($query, $data = []): int;

    public function insert($query, $data = []): string;
}