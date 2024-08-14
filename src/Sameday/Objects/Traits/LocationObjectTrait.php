<?php

namespace Sameday\Objects\Traits;

use Sameday\Objects\ScheduleObject;

/**
 * Trait for object name.
 *
 * @package Sameday
 */
trait LocationObjectTrait
{
    /**
     * @var string $county
     */
    protected $county;

    /**
     * @var string $country
     */
    protected $country;

    /**
     * @var string $city
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
     * @var string $lat
     */
    protected $lat;

    /**
     * @var string $long
     */
    protected $long;

    /**
     * @var string $phone;
     */
    protected $phone;

    /**
     * @var string $email
     */
    protected $email;

    /**
     * @var ScheduleObject[]
     */
    protected $schedule;

    /**
     * @return string
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
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
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @return string
     */
    public function getLong()
    {
        return $this->long;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return ScheduleObject[]
     */
    public function getSchedule()
    {
        return $this->schedule;
    }
}
