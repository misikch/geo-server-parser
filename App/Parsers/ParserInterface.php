<?php

namespace App\Parsers;

use App\Db\DbConnectionInterface;

interface ParserInterface
{
    public function __construct(DbConnectionInterface $dbConnection);

    public function parse();
}