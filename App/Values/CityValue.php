<?php

namespace App\Values;

class CityValue
{
    /**
     * @var string
     */
    private $countryCode;
    /**
     * @var string
     */
    private $regionLevel1Code;
    /**
     * @var string
     */
    private $regionLevel2Code;
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $geonameId;

    public function __construct(array $data)
    {
        $this->geonameId = $data[0];
        $this->name = $data[1];
        $this->regionLevel1Code = $data[2];
        $this->regionLevel2Code = $data[3];
        $this->countryCode = $data[4];
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @return string
     */
    public function getRegionLevel1Code(): string
    {
        return $this->regionLevel1Code;
    }

    /**
     * @return string
     */
    public function getRegionLevel2Code(): string
    {
        return $this->regionLevel2Code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getGeonameId(): int
    {
        return $this->geonameId;
    }

}