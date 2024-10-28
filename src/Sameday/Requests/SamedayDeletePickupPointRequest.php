<?php

namespace Sameday\Requests;

use Sameday\Http\SamedayRequest;

class SamedayDeletePickupPointRequest implements SamedayRequestInterface
{
    /**
     * @var int $pickupPointId
     */
    public $pickupPointId;

    public function __construct($pickupPointId)
    {
        $this->pickupPointId = $pickupPointId;
    }

    public function buildRequest()
    {
        return new SamedayRequest(
            true,
            'DELETE',
            sprintf('/api/client/pickup-points/%s', $this->getPickupPointId())
        );
    }

    /**
     * @return int
     */
    public function getPickupPointId()
    {
        return $this->pickupPointId;
    }

    /**
     * @param $pickupPointId
     *
     * @return $this
     */
    public function setPickupPointId($pickupPointId)
    {
        $this->pickupPointId = $pickupPointId;

        return $this;
    }
}
