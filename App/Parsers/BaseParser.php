<?php

namespace App\Parsers;

use App\Db\DbConnectionInterface;

abstract class BaseParser
{
    /**
     * @var DbConnectionInterface
     */
    protected $dbConnection;

    public function __construct(DbConnectionInterface $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }
}