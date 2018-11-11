<?php

use App\Components\DbInit;

require __DIR__ . '/vendor/autoload.php';

$dbConnection = (new \App\Db\MysqlDbConnection());

$parsers = [
    \App\Parsers\CountryParser::class,
    \App\Parsers\RegionsLevel1Parser::class,
    \App\Parsers\RegionsLevel2Parser::class,
    \App\Parsers\CitiesParser::class,
    \App\Parsers\RegionsAndCitiesLangsParser::class,
];

$startTime = microtime(true);

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

printTimeDiff($startTime);


function printTimeDiff($startTime)
{
    echo PHP_EOL . 'running time: ', microtime(true) - $startTime . ' sec. ', PHP_EOL;
}
