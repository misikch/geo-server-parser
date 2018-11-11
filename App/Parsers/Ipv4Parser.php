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

            if (false === $this->validateIpv4Value($ipv4Value)) {
                return;
            }

            $query = "INSERT INTO `geo_ipv4` (`ip_from`, `ip_to`, `country_code`, `country_name`, 
                    `region_name`, `city_name`, `lat`, `lng`, `region_code`, `timezone`)  
                      VALUES (:ip_from, :ip_to, :country_code, :country_name, :region_name, :city_name, 
                      :lat, :lng, :region_code, :timezone); ";
            $data = [
                'ip_from' => $ipv4Value->getIpFrom(),
                'ip_to' => $ipv4Value->getIpTo(),
                'country_code' => $ipv4Value->getCountryCode(),
                'country_name' => $ipv4Value->getCountryName(),
                'region_name' => $ipv4Value->getRegionName(),
                'city_name' => $ipv4Value->getCityName(),
                'lat' => $ipv4Value->getLat(),
                'lng' => $ipv4Value->getLng(),
                'region_code' => $ipv4Value->getRegionCode(),
                'timezone' => $ipv4Value->getTimezone(),
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

    private function validateIpv4Value(Ipv4Value $value): bool
    {
        if (empty($value->getCountryCode()) || '-' == $value->getCountryCode()) {
            return false;
        }

        if (empty($value->getIpTo()) || empty($value->getIpFrom())) {
            return false;
        }

        return true;
    }
}