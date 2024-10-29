<?php

namespace Sameday\Requests;

use Sameday\Http\RequestBodyUrlEncoded;
use Sameday\Http\SamedayRequest;
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
     * @var PickupPointContactPersonObject[] $contactPerson
     */
    protected $contactPerson;

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
        $this->contactPerson = $contactPerson;
        $this->defaultPickupPoint = $defaultPickupPoint;
    }

    /**
     * @return SamedayRequest
     */
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
                    'pickupPointContactPerson' => array_map(
                        static function (PickupPointContactPersonObject $contactPerson) {
                            return [
                                'name' => $contactPerson->getName(),
                                'phoneNumber' => $contactPerson->getPhoneNumber(),
                                'default' => $contactPerson->isDefault()
                            ];
                        },
                        $this->getContactPersons()
                    ),
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
     * @return PickupPointContactPersonObject[]
     */

    public function getContactPersons()
    {
        return $this->contactPerson;
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
