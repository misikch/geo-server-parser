<?php

use App\Components\DbInit;

require __DIR__ . '/vendor/autoload.php';

$dbConnection = (new \App\Db\MysqlDbConnection());

$parsers = [
    \App\Parsers\CountryParser::class,
    \App\Parsers\RegionsLevel1Parser::class,
];

/**
 * init tables
 */
(new DbInit())->init();

/**
 * run parsers
 */
foreach ($parsers as $parser) {
    /**
     * @var \App\Parsers\ParserInterface $parserInstance
     */
    $parserInstance = new $parser($dbConnection);
    $parserInstance->parse();
}

