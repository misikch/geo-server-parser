<?php

namespace App\Values;

class Ipv4Value
{
    /**
     * @var int
     */
    private $ipFrom;
    /** @var int */
    private $ipTo;
    /**
     * @var string
     */
    private $countryCode;
    /**
     * @var string
     */
    private $countryName;
    /**
     * @var string
     */
    private $regionName;
    /**
     * @var string
     */
    private $cityName;
    /**
     * @var string
     */
    private $lat;
    /**
     * @var string
     */
    private $lng;
    /**
     * @var string
     */
    private $regionCode;
    /**
     * @var string
     */
    private $timezone;

    public function __construct(array $data)
    {
        $this->ipFrom = $data[0];
        $this->ipTo = $data[1];
        $this->countryCode = $data[2];
        $this->countryName = $data[3];
        $this->regionName = $data[4];
        $this->cityName = $data[5];
        $this->lat = $data[6];
        $this->lng = $data[7];
        $this->regionCode = $data[8];
        $this->timezone = $data[9];
    }

    /**
     * @return int
     */
    public function getIpFrom(): int
    {
        return $this->ipFrom;
    }

    /**
     * @return int
     */
    public function getIpTo(): int
    {
        return $this->ipTo;
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
    public function getCountryName(): string
    {
        return $this->countryName;
    }

    /**
     * @return string
     */
    public function getRegionName(): string
    {
        return $this->regionName;
    }

    /**
     * @return string
     */
    public function getCityName(): string
    {
        return $this->cityName;
    }

    /**
     * @return string
     */
    public function getLat(): string
    {
        return $this->lat;
    }

    /**
     * @return string
     */
    public function getLng(): string
    {
        return $this->lng;
    }

    /**
     * @return string
     */
    public function getRegionCode(): string
    {
        return $this->regionCode;
    }

    /**
     * @return string
     */
    public function getTimezone(): string
    {
        return $this->timezone;
    }

}