<?php

namespace Sameday\Objects\PickupPoint;

use Sameday\Objects\CountryObject;
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
     * @var CountryObject $country
     */
    protected $country;

    /**
     * @var CountyObject
     */
    protected $county;

    /**
     * @var CityObject
     */
    protected $city;

    /**
     * @var string $address
     */
    protected $address;

    /**
     * @var string $postalCode
     */
    protected $postalCode;

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
     * @param $id
     * @param CountryObject $countryObject
     * @param CountyObject $countyObject
     * @param CityObject $cityObject
     * @param $address
     * @param $default
     * @param array $contactPersons
     * @param $alias
     * @param $postalCode
     */
    public function __construct(
        $id,
        CountryObject $countryObject,
        CountyObject $countyObject,
        CityObject $cityObject,
        $address,
        $default,
        array $contactPersons,
        $alias,
        $postalCode = null
    ) {
        $this->id = $id;
        $this->country = $countryObject;
        $this->county = $countyObject;
        $this->city = $cityObject;
        $this->address = $address;
        $this->default = $default;
        $this->contactPersons = $contactPersons;
        $this->alias = $alias;
        $this->postalCode = $postalCode;
    }

    /**
     * @return CountryObject
     */
    public function getCountry()
    {
        return $this->country;
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

    /**
     * @return ?string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }
}
