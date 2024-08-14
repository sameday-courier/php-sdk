<?php

namespace Sameday\Objects\Location;

use Sameday\Objects\Traits\LocationObjectTrait;
use Sameday\Objects\Traits\SamedayObjectIdTrait;
use Sameday\Objects\Traits\SamedayObjectNameTrait;

/**
 * LocationObject
 */
class LocationObject
{
    const OOH_EASYBOX = 'Locker NextDay';
    const OOH_PUDO = 'Pudo';
    const OOH_EASYBOX_CODE = 'LN';
    const OOH_PUDO_CODE = 'PP';

    use SamedayObjectIdTrait;
    use SamedayObjectNameTrait;
    use LocationObjectTrait;

    /**
     * @var int $oohType
     *
     * 0 - EasyBox locations
     * 1 - PUDO locations
     */
    protected $oohType;

    /**
     * @param $id
     * @param $name
     * @param $county
     * @param $country
     * @param $city
     * @param $address
     * @param $postalCode
     * @param $lat
     * @param $long
     * @param $phone
     * @param $email
     * @param array $schedule
     * @param $oohType
     */
    public function __construct(
        $id,
        $name,
        $county,
        $country,
        $city,
        $address,
        $postalCode,
        $lat,
        $long,
        $phone,
        $email,
        array $schedule,
        $oohType
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->county = $county;
        $this->country = $country;
        $this->city = $city;
        $this->address = $address;
        $this->postalCode = $postalCode;
        $this->lat = $lat;
        $this->long = $long;
        $this->phone = $phone;
        $this->email = $email;
        $this->schedule = $schedule;
        $this->oohType = $oohType;
    }

    /**
     * @return string|null
     */
    public function getServiceType()
    {
        if ($this->oohType === 0) {
            return self::OOH_EASYBOX;
        }

        if ($this->oohType === 1) {
            return self::OOH_PUDO;
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getServiceTypeCode()
    {
        if ($this->oohType === 0) {
            return self::OOH_EASYBOX_CODE;
        }

        if ($this->oohType === 1) {
            return self::OOH_PUDO_CODE;
        }

        return null;
    }
}
