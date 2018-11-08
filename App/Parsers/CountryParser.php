<?php

namespace App\Parsers;

use App\Db\DbConnectionInterface;
use App\Exception\AppException;
use App\Traits\FileRunnerTrait;
use App\Values\CountryValue;

class CountryParser extends BaseParser implements ParserInterface
{
    use FileRunnerTrait;

    private $countiesFile = __DIR__ . '/../../Sourses/country-codes_csv.csv';

    public function __construct(DbConnectionInterface $dbConnection)
    {
        parent::__construct($dbConnection);
    }

    public function parse()
    {
        $parseFunction = $this->getParserFunction();

        $this->runFile($this->countiesFile, $parseFunction);
    }

    private function getParserFunction(): \Closure
    {
        $dbConnection = $this->dbConnection;
        $count = 0;

        return function (string $line) use ($dbConnection, &$count) {
            if (0 === $count++) {
                return;
            }

            $countryValue = $this->getLineAsValueObject($line);

            if (empty($countryValue->getEnglishShortName()) || empty($countryValue->getCountryCode())) {
                return;
            }

            $insertedCountryId = $this->insertDataIntoGeoCountriesTable($countryValue);

            if (! $insertedCountryId) {
                throw new AppException("Error while inserting country");
            }

            if ($countryValue->getNameEn()) {
                $this->insertIntoGeoCountriesNames($countryValue->getNameEn(), 'en', $countryValue->getCountryCode());
            }

            if ($countryValue->getNameEs()) {
                $this->insertIntoGeoCountriesNames($countryValue->getNameEs(), 'es', $countryValue->getCountryCode());
            }

            if ($countryValue->getNameRu()) {
                $this->insertIntoGeoCountriesNames($countryValue->getNameRu(), 'ru', $countryValue->getCountryCode());
            }
        };
    }

    /**
     * @param string $line
     * @return CountryValue
     */
    private function getLineAsValueObject(string $line): CountryValue
    {
        return new CountryValue(explode(',', $line));
    }

    private function insertIntoGeoCountriesNames(string $countryName, string $lang, string $countryCode): int
    {
        $query = " INSERT INTO `geo_counties_names` (`name`, `lang`, `country_code`) VALUES (:country_name, :lang, :country_code); ";
        $data = [
            'country_name' => $countryName,
            'lang' => $lang,
            'country_code' => $countryCode,
        ];

        return (int) $this->dbConnection->insert($query, $data);
    }

    private function insertDataIntoGeoCountriesTable(CountryValue $countryValue): int
    {
        $query = " INSERT INTO `geo_counties`  (`name`, `code`) VALUES (:country_name, :country_code); ";
        $data = [
            'country_name' => $countryValue->getEnglishShortName(),
            'country_code' => $countryValue->getCountryCode(),
        ];

        return (int) $this->dbConnection->insert($query, $data);
    }
}