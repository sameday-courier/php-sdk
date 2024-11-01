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
     * 0 = doesn't support payment, 1 = supports payment
     *
     * @var int $supportedPayment
     */
    protected $supportedPayment;

    /**
     * 0 = not visible, 1 = visible
     *
     * @var int
     */
    protected $clientVisible;

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
        $supportedPayment,
        $clientVisible,
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
        $this->supportedPayment = $supportedPayment;
        $this->clientVisible = $clientVisible;
    }

    /**
     * @return BoxObject[]
     */
    public function getBoxes()
    {
        return $this->boxes;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return LockerObject
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return int
     */
    public function getSupportedPayment()
    {
        return $this->supportedPayment;
    }

    /**
     * @param int $supportedPayment
     *
     * @return LockerObject
     */
    public function setSupportedPayment($supportedPayment)
    {
        $this->supportedPayment = $supportedPayment;

        return $this;
    }

    /**
     * @return int
     */
    public function getClientVisible()
    {
        return $this->clientVisible;
    }

    /**
     * @param int $clientVisible
     *
     * @return LockerObject
     */
    public function setClientVisible($clientVisible)
    {
        $this->clientVisible = $clientVisible;

        return $this;
    }
}
