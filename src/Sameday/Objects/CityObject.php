<?php

namespace Sameday\Objects;

use Sameday\Objects\Traits\SamedayObjectIdTrait;
use Sameday\Objects\Traits\SamedayObjectNameTrait;

/**
 * City.
 *
 * @package Sameday
 */
class CityObject
{
    use SamedayObjectIdTrait;
    use SamedayObjectNameTrait;

    /**
     * @var CountyObject
     */
    protected $county;

    /**
     * @var string
     */
    protected $postalCode;

    /**
     * @var int
     */
    protected $extraKM;

    /**
     * @var string
     */
    protected $village;

    /**
     * CityObject constructor.
     *
     * @param int $id
     * @param string $name
     * @param CountyObject $county
     * @param string $postalCode
     * @param int $extraKM
     * @param string $village
     */
    public function __construct($id, $name, CountyObject $county, $postalCode, $extraKM, $village)
    {
        $this->id = $id;
        $this->name = $name;
        $this->county = $county;
        $this->postalCode = $postalCode;
        $this->extraKM = $extraKM;
        $this->village = $village;
    }

    /**
     * @return CountyObject
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return int
     */
    public function getExtraKM()
    {
        return $this->extraKM;
    }

    /**
     * @return string
     */
    public function getVillage()
    {
        return $this->village;
    }
}
