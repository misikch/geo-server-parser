<?php

namespace App\Values;

class RegionLevel1Value
{
    /**
     * @var string
     */
    private $countryCode;
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
        $this->code = $data[1];
        $this->name = $data[2];
        $this->geonameId = $data[3];
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