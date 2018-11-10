<?php

namespace App\Parsers;

use App\Db\DbConnectionInterface;
use App\Traits\FileRunnerTrait;
use App\Values\RegionLevel1Value;

class RegionsLevel1Parser  extends BaseParser implements ParserInterface
{
    use FileRunnerTrait;

    private $regions1File = __DIR__ . '/../../Sources/admin1CodesASCII.txt';

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
            $regionLevel1Value = $this->getRegionLevel1ValueFromString($line);

            $query = "INSERT INTO `geo_regions_level1` (`id`, `name`, `code`, `country_code`)  VALUES (:id, :r_name, :code, :country_code); ";
            $data = [
                'id' => $regionLevel1Value->getGeonameId(),
                'r_name' => $regionLevel1Value->getName(),
                'code' => $regionLevel1Value->getCode(),
                'country_code' => $regionLevel1Value->getCountryCode(),
            ];

            $dbConnection->insert($query, $data);
        };
    }

    private function getRegionLevel1ValueFromString(string $line): RegionLevel1Value
    {
        $lineAsArray = explode("\t", $line);

        list($countryCode, $code) = explode('.', $lineAsArray[0]);

        $data = [
            $countryCode,
            $code,
            $lineAsArray[1],
            (int) $lineAsArray[3],
        ];

        return new RegionLevel1Value($data);
    }

}