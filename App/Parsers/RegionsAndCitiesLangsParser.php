<?php

namespace App\Parsers;

use App\Db\DbConnectionInterface;
use App\Traits\FileRunnerTrait;
use App\Values\RegionAndCityLangsValue;

class RegionsAndCitiesLangsParser  extends BaseParser implements ParserInterface
{
    use FileRunnerTrait;

    private $regions1File = __DIR__ . '/../../Sources/alternateNames.txt';

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
            $regionAndCityLangValue = $this->getRegionAndCityLangValueFromString($line);

            if (false === $this->validateData($regionAndCityLangValue)) {
                return;
            }


            $query = "INSERT INTO `geo_alter_names` (`id`, `geoname_id`, `lang`, `name`, `is_prefered_name`)  
                  VALUES (:id, :geoname_id, :lang, :r_name, :is_prefered_name); ";

            $data = [
                'id' => $regionAndCityLangValue->getNameId(),
                'geoname_id' => $regionAndCityLangValue->getGeoanmeId(),
                'lang' => $regionAndCityLangValue->getLang(),
                'r_name' => $regionAndCityLangValue->getName(),
                'is_prefered_name' => $regionAndCityLangValue->getIsPreferedName(),
            ];

            $dbConnection->insert($query, $data);
        };
    }

    private function getRegionAndCityLangValueFromString(string $line): RegionAndCityLangsValue
    {
        $lineAsArray = explode("\t", $line);

        $data = [
            (int) $lineAsArray[0],
            (int) $lineAsArray[1],
            $lineAsArray[2],
            $lineAsArray[3],
            (int) $lineAsArray[4],
            (int) $lineAsArray[5],
            (int) $lineAsArray[6],
            (int) $lineAsArray[7],
        ];

        return new RegionAndCityLangsValue($data);
    }

    private function validateData(RegionAndCityLangsValue $value)
    {
        if (empty($value->getNameId()) || empty($value->getGeoanmeId()) || empty($value->getLang()))
        {
            return false;
        }

        if (empty($value->getLang()) || false === in_array($value->getLang(), ['ru', 'en', 'es'])) {
            return false;
        }

        if ($value->getIsShortName() || $value->getIsSlangName() || $value->getIsUsedInHistory()) {
            return false;
        }

        return true;
    }

}