<?php

namespace Sameday\Objects\Locker;

use Sameday\Objects\BoxObject;
use Sameday\Objects\ScheduleObject;
use Sameday\Objects\Traits\LocationObjectTrait;
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
    use LocationObjectTrait;

    /**
     * @var BoxObject[]
     */
    protected $boxes;

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
     * @return BoxObject[]
     */
    public function getBoxes()
    {
        return $this->boxes;
    }
}
