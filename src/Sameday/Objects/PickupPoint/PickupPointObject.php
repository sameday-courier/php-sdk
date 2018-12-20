<?php

namespace Sameday\Objects\PickupPoint;

use Sameday\Objects\CountyObject;
use Sameday\Objects\Traits\SamedayObjectIdTrait;

/**
 * Pickup point.
 *
 * @package Sameday
 */
class PickupPointObject
{
    use SamedayObjectIdTrait;

    /**
     * @var CountyObject
     */
    protected $county;

    /**
     * @var CityObject
     */
    protected $city;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var bool
     */
    protected $default;

    /**
     * @var ContactPersonObject[]
     */
    protected $contactPersons;

    /**
     * @var string
     */
    protected $alias;

    /**
     * PickupPointObject constructor.
     *
     * @param int $id
     * @param CountyObject $county
     * @param CityObject $city
     * @param string $address
     * @param bool $default
     * @param ContactPersonObject[] $contactPersons
     * @param string $alias
     */
    public function __construct(
        $id,
        CountyObject $county,
        CityObject $city,
        $address,
        $default,
        array $contactPersons,
        $alias
    ) {
        $this->id = $id;
        $this->county = $county;
        $this->city = $city;
        $this->address = $address;
        $this->default = $default;
        $this->contactPersons = $contactPersons;
        $this->alias = $alias;
    }

    /**
     * @return CountyObject
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * @return CityObject
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return bool
     */
    public function isDefault()
    {
        return $this->default;
    }

    /**
     * @return ContactPersonObject[]
     */
    public function getContactPersons()
    {
        return $this->contactPersons;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }
}
