<?php

namespace App\Parsers;

use App\Config\Config;
use App\Db\DbConnectionInterface;
use App\Exceptions\AppException;
use App\Traits\FileRunnerTrait;
use App\Values\CountryValue;
use App\Values\Ipv4Value;

class Ipv4Parser extends BaseParser implements ParserInterface
{
    use FileRunnerTrait;

    private $ipv4FileName = __DIR__ . '/../../Sources/IP2LOCATION-LITE-DB11.CSV';

    public function __construct(DbConnectionInterface $dbConnection)
    {
        parent::__construct($dbConnection);
    }

    public function parse()
    {
        $parseFunction = $this->getParseFunction();

        $this->runFile($this->ipv4FileName, $parseFunction);
    }

    private function getParseFunction(): \Closure
    {
        $dbConnection = $this->dbConnection;

        return function ($line) use ($dbConnection) {
            $ipv4Value = $this->getIpv4ValueFromString($line);

            var_dump($ipv4Value);

            $query = "INSERT INTO `geo_regions_level1` (`id`, `name`, `code`, `country_code`)  VALUES (:id, :r_name, :code, :country_code); ";
            $data = [
                'id' => $ipv4Value->getGeonameId(),
                'r_name' => $ipv4Value->getName(),
                'code' => $ipv4Value->getCode(),
                'country_code' => $ipv4Value->getCountryCode(),
            ];

            $dbConnection->insert($query, $data);
        };
    }

    private function getIpv4ValueFromString(string $line): Ipv4Value
    {
        $line = trim($line, '"');

        $lineAsArray = explode('","', $line);

        $lineAsArray[0] = (int) $lineAsArray[0];
        $lineAsArray[1] = (int) $lineAsArray[1];


        return new Ipv4Value($lineAsArray);
    }
}