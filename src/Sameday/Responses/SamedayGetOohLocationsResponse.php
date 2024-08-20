<?php

namespace Sameday\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\Location\LocationObject;
use Sameday\Objects\ScheduleObject;
use Sameday\Requests\SamedayGetOohLocationsRequest;
use Sameday\Responses\Traits\SamedayResponsePaginationTrait;
use Sameday\Responses\Traits\SamedayResponseTrait;

/**
 * Response for get ooh locations request.
 *
 * @package Sameday
 */
class SamedayGetOohLocationsResponse implements SamedayPaginatedResponseInterface
{
    use SamedayResponsePaginationTrait;
    use SamedayResponseTrait;

    /**
     * @var array
     */
    protected $locations = [];

    /**
     * @param SamedayGetOohLocationsRequest $request
     * @param SamedayRawResponse $rawResponse
     */
    public function __construct(SamedayGetOohLocationsRequest $request, SamedayRawResponse $rawResponse)
    {
        $this->request = $request;
        $this->rawResponse = $rawResponse;

        $json = json_decode($this->rawResponse->getBody(), true);
        $this->parsePagination($this->request, $json);
        if (!$json) {
            // Empty response.
            return;
        }

        foreach ($json['data'] as $location) {
            $this->locations[$location['oohId']] = new LocationObject(
                $location['oohId'],
                $location['name'],
                $location['county'],
                $location['country'],
                $location['city'],
                $location['address'],
                $location['postalCode'],
                $location['lat'],
                $location['lng'],
                $location['phone'],
                $location['email'],
                array_map(
                    static function ($entry) {
                        return new ScheduleObject(
                            $entry['day'],
                            $entry['openingHour'],
                            $entry['closingHour']
                        );
                    },
                    $location['schedule']
                ),
                $location['oohType']
            );
        }
    }

    /**
     * @return LocationObject[]
     */
    public function getLocations()
    {
        return $this->locations;
    }
}
