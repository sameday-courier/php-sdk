<?php

namespace Sameday\Objects\Locker;

use Sameday\Objects\Traits\SamedayObjectIdTrait;
use Sameday\Objects\Traits\SamedayObjectNameTrait;

/**
 * Locker.
 *
 * @package Sameday
 */
class LockerObject
{
    use SamedayObjectIdTrait;
    use SamedayObjectNameTrait;

    /**
     * @var string
     */
    protected $county;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var string
     */
    protected $postalCode;

    /**
     * @var string
     */
    protected $lat;

    /**
     * @var string
     */
    protected $long;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var BoxObject[]
     */
    protected $boxes;

    /**
     * @var ScheduleObject[]
     */
    protected $schedule;

    /**
     * LockerObject constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $county
     * @param string $city
     * @param string $address
     * @param string $postalCode
     * @param string $lat
     * @param string $long
     * @param string $phone
     * @param string $email
     * @param BoxObject[] $boxes
     * @param ScheduleObject[] $schedule
     */
    public function __construct(
        $id,
        $name,
        $county,
        $city,
        $address,
        $postalCode,
        $lat,
        $long,
        $phone,
        $email,
        array $boxes,
        array $schedule
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->county = $county;
        $this->city = $city;
        $this->address = $address;
        $this->postalCode = $postalCode;
        $this->lat = $lat;
        $this->long = $long;
        $this->phone = $phone;
        $this->email = $email;
        $this->boxes = $boxes;
        $this->schedule = $schedule;
    }

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
     * @return BoxObject[]
     */
    public function getBoxes()
    {
        return $this->boxes;
    }

    /**
     * @return ScheduleObject[]
     */
    public function getSchedule()
    {
        return $this->schedule;
    }
}
