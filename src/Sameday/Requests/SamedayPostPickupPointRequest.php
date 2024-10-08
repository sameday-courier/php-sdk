<?php

namespace Sameday\Requests;

use Sameday\Http\RequestBodyUrlEncoded;
use Sameday\Http\SamedayRequest;
use Sameday\Objects\PickupPoint\PickupPointObject;

class SamedayPostPickupPointRequest implements SamedayRequestInterface
{
    /**
     * @var PickupPointObject $pickupPoint
     */
    public $pickupPoint;

    public function __construct(PickupPointObject $pickupPoint)
    {
        $this->pickupPoint = $pickupPoint;
    }

    public function buildRequest()
    {
        return new SamedayRequest(
            true,
            'POST',
            '/api/client/pickup-points',
            [],
            new RequestBodyUrlEncoded(
                [
                    'country' => $this->pickupPoint->getCountry()->getId(),
                    'county' => $this->pickupPoint->getCounty()->getId(),
                    'city' => $this->pickupPoint->getCity()->getId(),
                    'address' => $this->pickupPoint->getAddress(),
                    'postalCode' => $this->pickupPoint->getPostalCode(),
                    'alias' => $this->pickupPoint->getAlias(),
                    'contactPerson' => $this->pickupPoint->getContactPersons(),
                    'defaultPickupPoint' => $this->pickupPoint->isDefault(),
                ]
            )
        );
    }
}
