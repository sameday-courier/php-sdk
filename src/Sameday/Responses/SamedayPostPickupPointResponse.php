<?php

namespace Sameday\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\PickupPoint\ContactPersonObject;
use Sameday\Requests\SamedayPostPickupPointRequest;
use Sameday\Responses\Traits\SamedayResponseTrait;

class SamedayPostPickupPointResponse implements SamedayResponseInterface
{
    use SamedayResponseTrait;

    /**
     * @var int $pickupPointId
     */
    private $pickupPointId;

    /**
     * @var ContactPersonObject[] $contactPersons
     */
    private $contactPersons;

    public function __construct(
        SamedayPostPickupPointRequest $request,
        SamedayRawResponse $rawResponse
    ) {
        $this->request = $request;
        $this->rawResponse = $rawResponse;

        $json = json_decode($this->rawResponse->getBody(), true);
        if (!$json) {
            // Empty response.
            return;
        }

        $this->pickupPointId = $json['id'];
        $this->contactPersons = array_map(
            static function (array $contactPerson) {
                return new ContactPersonObject(
                    $contactPerson['id'],
                    $contactPerson['name'],
                    $contactPerson['phoneNumber'],
                    isset($contactPerson['default']) ? $contactPerson['default'] : true
                );
            },
            $json['contactPersons']
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
     * @return ContactPersonObject[]
     */
    public function getContactPersons()
    {
        return $this->contactPersons;
    }
}
