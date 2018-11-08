<?php

namespace App\Db;

interface DbConnectionInterface
{
    public function query(string $query, $data = []): int;

    public function insert(string $query, $data = []): string;
}