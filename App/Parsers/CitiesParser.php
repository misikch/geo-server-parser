<?php

namespace App\Parsers;

use App\Db\DbConnectionInterface;
use App\Traits\FileRunnerTrait;
use App\Values\CityValue;

class CitiesParser  extends BaseParser implements ParserInterface
{
    use FileRunnerTrait;

    private $regions1File = __DIR__ . '/../../Sources/cities15000.txt';

    public function __construct(DbConnectionInterface $dbConnection)
    {
        parent::__construct($dbConnection);
    }

    public function parse()
    {
        $parseFunction = $this->getParseFunction();

        $this->runFile($this->regions1File, $parseFunction);
    }

    private function getParseFunction(): \Closure
    {
        $dbConnection = $this->dbConnection;

        return function ($line) use ($dbConnection) {
            $cityValue = $this->getCityValueFromString($line);

            $regionLevel2CodePrepared = $this->regionLevel2CodePrepare($cityValue->getRegionLevel2Code());

            $query = "INSERT INTO `geo_cities` (`id`, `name`, `region_level1_code`, `region_level2_code`,`country_code`) 
                      VALUES (:id, :r_name, :region_level1_code, :region_level2_code, :country_code); ";
            $data = [
                'id' => $cityValue->getGeonameId(),
                'r_name' => $cityValue->getName(),
                'region_level1_code' => $cityValue->getRegionLevel1Code(),
                'region_level2_code' => $regionLevel2CodePrepared,
                'country_code' => $cityValue->getCountryCode(),
            ];

            $dbConnection->insert($query, $data);
        };
    }

    private function getCityValueFromString(string $line): CityValue
    {
        $lineAsArray = explode("\t", $line);



        $data = [
            $lineAsArray[0],
            $lineAsArray[1],
            $lineAsArray[10],
            $lineAsArray[11],
            $lineAsArray[8],
        ];

        return new CityValue($data);
    }

    private function regionLevel2CodePrepare(string $regionLevel2Code)
    {
        if ('Cape Breton County (undefined)' === $regionLevel2Code) {
            return '5915565';
        }

        if ('Vasylkiv Raion (undefined)' === $regionLevel2Code) {
            return '690405';
        }

        return $regionLevel2Code;
    }

}