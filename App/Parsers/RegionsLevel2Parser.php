<?php

namespace App\Parsers;

use App\Db\DbConnectionInterface;
use App\Traits\FileRunnerTrait;
use App\Values\RegionLevel2Value;

class RegionsLevel2Parser  extends BaseParser implements ParserInterface
{
    use FileRunnerTrait;

    private $regions1File = __DIR__ . '/../../Sources/admin2Codes.txt';

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
            $regionLevel2Value = $this->getRegionLevel2ValueFromString($line);

            $regionLevel1CodePrepared = $this->prepareRegionLevel1Code($regionLevel2Value->getRegionLevel1Code());

            $query = "INSERT INTO `geo_regions_level2` (`id`, `name`, `region_level1_code`, `code`, `country_code`)  
                        VALUES (:id, :r_name, :region_level1_code, :code, :country_code); ";
            $data = [
                'id' => $regionLevel2Value->getGeonameId(),
                'r_name' => $regionLevel2Value->getName(),
                'region_level1_code' => $regionLevel1CodePrepared,
                'code' => $regionLevel2Value->getCode(),
                'country_code' => $regionLevel2Value->getCountryCode(),
            ];

            $dbConnection->insert($query, $data);
        };
    }

    private function getRegionLevel2ValueFromString(string $line): RegionLevel2Value
    {
        $lineAsArray = explode("\t", $line);

        list($countryCode, $regionLevel1Code, $code) = explode('.', $lineAsArray[0]);

        $data = [
            $countryCode,
            $regionLevel1Code,
            $code,
            $lineAsArray[1],
            (int) $lineAsArray[3],
        ];

        return new RegionLevel2Value($data);
    }

    private function prepareRegionLevel1Code(string $regionLevel1Code): string
    {
        if ('Shymkent (undefined)' === $regionLevel1Code) {
            return '1537272';
        }

        return $regionLevel1Code;

    }

}