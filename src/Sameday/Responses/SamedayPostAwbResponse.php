<?php

namespace Sameday\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\PostAwb\ParcelObject;
use Sameday\Requests\SamedayPostAwbRequest;
use Sameday\Responses\Traits\SamedayResponseTrait;

/**
 * Response for creating a new AWB request.
 *
 * @package Sameday
 */
class SamedayPostAwbResponse implements SamedayResponseInterface
{
    use SamedayResponseTrait;

    /**
     * @var string
     */
    protected $awbNumber;

    /**
     * @var float
     */
    protected $cost;

    /**
     * @var ParcelObject[]
     */
    protected $parcels;

    /**
     * SamedayPostAwbResponse constructor.
     *
     * @param SamedayPostAwbRequest $request
     * @param SamedayRawResponse $rawResponse
     */
    public function __construct(SamedayPostAwbRequest $request, SamedayRawResponse $rawResponse)
    {
        $this->request = $request;
        $this->rawResponse = $rawResponse;

        $json = json_decode($this->rawResponse->getBody(), true);
        if (!$json) {
            // Empty response.
            return;
        }

        $this->awbNumber = $json['awbNumber'];
        $this->cost = $json['awbCost'];

        $this->parcels = array_map(
            static function (array $parcel) {
                return new ParcelObject($parcel['position'], $parcel['awbNumber']);
            },
            $json['parcels']
        );
    }

    /**
     * @return string
     */
    public function getAwbNumber()
    {
        return $this->awbNumber;
    }

    /**
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @return ParcelObject[]
     */
    public function getParcels()
    {
        return $this->parcels;
    }
}
