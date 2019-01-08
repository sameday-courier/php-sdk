<?php

namespace Sameday\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\Service\DeliveryTypeObject;
use Sameday\Objects\Service\OptionalTaxObject;
use Sameday\Objects\Service\ServiceObject;
use Sameday\Objects\Types\CostType;
use Sameday\Objects\Types\PackageType;
use Sameday\Requests\SamedayGetServicesRequest;
use Sameday\Responses\Traits\SamedayResponsePaginationTrait;
use Sameday\Responses\Traits\SamedayResponseTrait;

/**
 * Response for get services request.
 *
 * @package Sameday
 */
class SamedayGetServicesResponse implements SamedayPaginatedResponseInterface
{
    use SamedayResponsePaginationTrait;
    use SamedayResponseTrait;

    /**
     * @var ServiceObject[]
     */
    protected $services = [];

    /**
     * SamedayGetServicesResponse constructor.
     *
     * @param SamedayGetServicesRequest $request
     * @param SamedayRawResponse $rawResponse
     */
    public function __construct(SamedayGetServicesRequest $request, SamedayRawResponse $rawResponse)
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
            $this->services[] = new ServiceObject(
                $data['id'],
                $data['name'],
                $data['serviceCode'],
                new DeliveryTypeObject($data['deliveryType']['id'], $data['deliveryType']['name']),
                $data['defaultServices'],
                array_map(
                    function ($entry) {
                        return new OptionalTaxObject(
                            $entry['id'],
                            $entry['name'],
                            new CostType($entry['costType']),
                            $entry['tax'],
                            new PackageType($entry['packageType'])
                        );
                    },
                    $data['serviceOptionalTaxes']
                )
            );
        }
    }

    /**
     * @return ServiceObject[]
     */
    public function getServices()
    {
        return $this->services;
    }
}
