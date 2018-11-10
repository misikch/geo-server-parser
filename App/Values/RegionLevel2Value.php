<?php

namespace App\Values;

class RegionLevel2Value
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
    private $code;
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
        $this->countryCode = $data[0];
        $this->regionLevel1Code = $data[1];
        $this->code = $data[2];
        $this->name = $data[3];
        $this->geonameId = $data[4];
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
    public function getCode(): string
    {
        return $this->code;
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