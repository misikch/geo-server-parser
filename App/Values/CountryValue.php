<?php

namespace App\Values;

class CountryValue
{
    /**
     * @var string
     */
    private $nameEn;
    /**
     * @var string
     */
    private $nameEs;
    /**
     * @var string
     */
    private $nameRu;
    /**
     * @var string
     */
    private $englishShortName;
    /**
     * @var string
     */
    private $countryCode;

    public function __construct(array $data)
    {
        $this->englishShortName = $data[27];
        $this->nameEn = $data[2];
        $this->nameEs = $data[3];
        $this->nameRu = $data[5];

        $this->countryCode = $data[6];
    }

    /**
     * @return string
     */
    public function getNameEn(): string
    {
        return $this->nameEn;
    }

    /**
     * @return string
     */
    public function getNameEs(): string
    {
        return $this->nameEs;
    }

    /**
     * @return string
     */
    public function getNameRu(): string
    {
        return $this->nameRu;
    }

    /**
     * @return string
     */
    public function getEnglishShortName(): string
    {
        return $this->englishShortName;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
}