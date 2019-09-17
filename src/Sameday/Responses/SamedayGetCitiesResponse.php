<?php

namespace Sameday\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\CityObject;
use Sameday\Objects\CountyObject;
use Sameday\Requests\SamedayGetCitiesRequest;
use Sameday\Responses\Traits\SamedayResponsePaginationTrait;
use Sameday\Responses\Traits\SamedayResponseTrait;

/**
 * Response for get cities request.
 *
 * @package Sameday
 */
class SamedayGetCitiesResponse implements SamedayPaginatedResponseInterface
{
    use SamedayResponsePaginationTrait;
    use SamedayResponseTrait;

    /**
     * @var CityObject[]
     */
    protected $cities = [];

    /**
     * SamedayGetCitiesResponse constructor.
     *
     * @param SamedayGetCitiesRequest $request
     * @param SamedayRawResponse $rawResponse
     */
    public function __construct(SamedayGetCitiesRequest $request, SamedayRawResponse $rawResponse)
    {
        $this->request = $request;
        $this->rawResponse = $rawResponse;

        $json = json_decode($this->rawResponse->getBody(), true);
        $this->parsePagination($this->request, $json);
        if (!$json) {
            // Empty response.
            return;
        }

        foreach ($json['data'] as $data) {
            $this->cities[] = new CityObject(
                $data['id'],
                $data['name'],
                new CountyObject(
                    $data['county']['id'],
                    $data['county']['name'],
                    $data['county']['code']
                ),
                $data['postalCode'],
                $data['extraKM'],
                $data['village']
            );
        }
    }

    /**
     * @return CityObject[]
     */
    public function getCities()
    {
        return $this->cities;
    }
}
