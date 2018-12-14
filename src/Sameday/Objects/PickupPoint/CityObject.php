<?php

namespace Sameday\Objects\PickupPoint;

use Sameday\Objects\Traits\SamedayObjectIdTrait;
use Sameday\Objects\Traits\SamedayObjectNameTrait;

/**
 * City for pickup point.
 *
 * @package Sameday
 */
class CityObject
{
    use SamedayObjectIdTrait;
    use SamedayObjectNameTrait;

    /**
     * @var string
     */
    protected $deliveryAgency;

    /**
     * @var string
     */
    protected $pickupAgency;

    /**
     * @var int
     */
    protected $extraKm;

    /**
     * CityObject constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $deliveryAgency
     * @param string $pickupAgency
     * @param int $extraKm
     */
    public function __construct(
        $id,
        $name,
        $deliveryAgency,
        $pickupAgency,
        $extraKm
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->deliveryAgency = $deliveryAgency;
        $this->pickupAgency = $pickupAgency;
        $this->extraKm = $extraKm;
    }

    /**
     * @return string
     */
    public function getDeliveryAgency()
    {
        return $this->deliveryAgency;
    }

    /**
     * @return string
     */
    public function getPickupAgency()
    {
        return $this->pickupAgency;
    }

    /**
     * @return int
     */
    public function getExtraKm()
    {
        return $this->extraKm;
    }
}
