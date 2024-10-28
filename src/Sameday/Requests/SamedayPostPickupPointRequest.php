<?php

namespace Sameday\Requests;

use Sameday\Http\RequestBodyUrlEncoded;
use Sameday\Http\SamedayRequest;
use Sameday\Objects\ContactPersonObject;
use Sameday\Objects\PickupPoint\PickupPointContactPersonObject;

class SamedayPostPickupPointRequest implements SamedayRequestInterface
{
    /**
     * @var int $countryId
     */
    protected $countryId;

    /**
     * @var int $countyId
     */
    protected $countyId;

    /**
     * @var string $cityId
     */
    protected $cityId;

    /**
     * @var string $address
     */
    protected $address;

    /**
     * @var string $postalCode
     */
    protected $postalCode;

    /**
     * @var string $alias
     */
    protected $alias;

    /**
     * @var PickupPointContactPersonObject[] $contactPersons
     */
    protected $contactPersons;

    /**
     * @var bool $defaultPickupPoint
     */
    protected $defaultPickupPoint;

    /**
     * PostPickupPointRequest Constructor
     *
     * @param $countryId
     * @param $countyId
     * @param $cityId
     * @param $address
     * @param $postalCode
     * @param $alias
     * @param PickupPointContactPersonObject[] $contactPerson
     * @param $defaultPickupPoint
     */
    public function __construct(
        $countryId,
        $countyId,
        $cityId,
        $address,
        $postalCode,
        $alias,
        array $contactPerson,
        $defaultPickupPoint
    ) {
        $this->countryId = $countryId;
        $this->countyId = $countyId;
        $this->cityId = $cityId;
        $this->address = $address;
        $this->postalCode = $postalCode;
        $this->alias = $alias;
        $this->contactPersons = $contactPerson;
        $this->defaultPickupPoint = $defaultPickupPoint;
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
                    'country' => $this->getCountryId(),
                    'county' => $this->getCountyId(),
                    'city' => $this->getCityId(),
                    'address' => $this->getAddress(),
                    'postalCode' => $this->getPostalCode(),
                    'alias' => $this->getAlias(),
                    'pickupPointContactPerson' => $this->getContactPersons(),
                    'defaultPickupPoint' => $this->isDefaultPickupPoint(),
                ]
            )
        );
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
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @return string
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * @return ContactPersonObject[]
     */
    public function getContactPersons()
    {
        return $this->contactPersons;
    }

    /**
     * @return int
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * @return int
     */
    public function getCountyId()
    {
        return $this->countyId;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return bool
     */
    public function isDefaultPickupPoint()
    {
        return $this->defaultPickupPoint;
    }
}
