<?php

use App\Components\DbInit;

require __DIR__ . '/vendor/autoload.php';

$dbConnection = (new \App\Db\MysqlDbConnection());

/**
 * init tables
 */
(new DbInit())->init();

/**
 * fill countries
 */
(new \App\Parsers\CountryParser($dbConnection))->parse();
