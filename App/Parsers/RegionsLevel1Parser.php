<?php

namespace App\Parsers;

use App\Db\DbConnectionInterface;

class RegionsLevel1Parser  extends BaseParser implements ParserInterface
{

    public function __construct(DbConnectionInterface $dbConnection)
    {
        parent::__construct($dbConnection);
    }

    public function parse()
    {

    }
}