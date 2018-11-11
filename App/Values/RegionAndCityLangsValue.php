<?php

namespace App\Values;

class RegionAndCityLangsValue
{
    /**
     * @var int
     */
    private $nameId;
    /**
     * @var int
     */
    private $geoanmeId;
    /**
     * @var string
     */
    private $lang;
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $isPreferedName;
    /**
     * @var int
     */
    private $isShortName;
    /**
     * @var int
     */
    private $isSlangName;
    /**
     * @var int
     */
    private $isUsedInHistory;

    public function __construct(array $data)
    {
        $this->nameId = $data[0];
        $this->geoanmeId = $data[1];
        $this->lang = $data[2];
        $this->name = $data[3];

        $this->isPreferedName = $data[4];
        $this->isShortName = $data[5];
        $this->isSlangName = $data[6];
        $this->isUsedInHistory = $data[7];
    }

    /**
     * @return int
     */
    public function getNameId(): int
    {
        return $this->nameId;
    }

    /**
     * @return int
     */
    public function getGeoanmeId(): int
    {
        return $this->geoanmeId;
    }

    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
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
    public function getIsPreferedName(): int
    {
        return $this->isPreferedName;
    }

    /**
     * @return int
     */
    public function getIsShortName(): int
    {
        return $this->isShortName;
    }

    /**
     * @return int
     */
    public function getIsSlangName(): int
    {
        return $this->isSlangName;
    }

    /**
     * @return int
     */
    public function getIsUsedInHistory(): int
    {
        return $this->isUsedInHistory;
    }

}