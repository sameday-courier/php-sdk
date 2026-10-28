<?php

namespace Sameday\Responses;

use DateTime;
use Exception;
use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\AwbStatusSync\DamageCheckObject;
use Sameday\Objects\AwbStatusSync\StatusSyncObject;
use Sameday\Requests\SamedayGetAwbStatusSyncRequest;
use Sameday\Responses\Traits\SamedayResponsePaginationTrait;
use Sameday\Responses\Traits\SamedayResponseTrait;

/**
 * Response for get AWB status sync request.
 *
 * @package Sameday
 */
class SamedayGetAwbStatusSyncResponse implements SamedayPaginatedResponseInterface
{
    use SamedayResponsePaginationTrait;
    use SamedayResponseTrait;

    /**
     * @var StatusSyncObject[]
     */
    protected $statuses = [];

    /**
     * SamedayGetAwbStatusSyncResponse constructor.
     *
     * @param SamedayGetAwbStatusSyncRequest $request
     * @param SamedayRawResponse $rawResponse
     *
     * @throws Exception
     */
    public function __construct(SamedayGetAwbStatusSyncRequest $request, SamedayRawResponse $rawResponse)
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
            $damageCheck = null;
            if (!empty($data['damageCheck']) && is_array($data['damageCheck'])) {
                $damageCheck = new DamageCheckObject(
                    isset($data['damageCheck']['id']) ? (int) $data['damageCheck']['id'] : 0,
                    isset($data['damageCheck']['label']) ? $data['damageCheck']['label'] : ''
                );
            }

            $this->statuses[] = new StatusSyncObject(
                $data['statusId'],
                $data['status'],
                $data['parcelAwbNumber'],
                $data['statusLabel'],
                $data['statusState'],
                new DateTime($data['statusDate']),
                isset($data['transitLocation']) ? $data['transitLocation'] : '',
                (!isset($data['reasonId']) || $data['reasonId'] === '') ? null : (int) $data['reasonId'],
                isset($data['reason']) ? $data['reason'] : '',
                isset($data['createdBy']) ? $data['createdBy'] : null,
                !empty($data['inReturn']),
                array_key_exists('itemsNo', $data) ? $data['itemsNo'] : null,
                isset($data['lockerDetails']) && is_array($data['lockerDetails']) ? $data['lockerDetails'] : [],
                isset($data['oohDetails']) && is_array($data['oohDetails']) ? $data['oohDetails'] : [],
                isset($data['tobaccoCheck']) ? (int) $data['tobaccoCheck'] : 0,
                isset($data['parcelDetails']) ? $data['parcelDetails'] : '',
                $damageCheck
            );
        }
    }

    /**
     * @return StatusSyncObject[]
     */
    public function getStatuses()
    {
        return $this->statuses;
    }
}
