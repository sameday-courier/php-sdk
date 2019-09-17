<?php

namespace Sameday\Responses;

use DateTime;
use Exception;
use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\AwbStatusHistory\ExpeditionObject;
use Sameday\Objects\AwbStatusHistory\HistoryObject;
use Sameday\Objects\AwbStatusHistory\ParcelObject;
use Sameday\Objects\AwbStatusHistory\SummaryObject;
use Sameday\Requests\SamedayGetAwbStatusHistoryRequest;
use Sameday\Responses\Traits\SamedayResponseTrait;

/**
 * Response for get awb history request.
 *
 * @package Sameday
 */
class SamedayGetAwbStatusHistoryResponse implements SamedayResponseInterface
{
    use SamedayResponseTrait;

    /**
     * @var SummaryObject
     */
    protected $summary;

    /**
     * @var HistoryObject[]
     */
    protected $history = [];

    /**
     * @var ExpeditionObject
     */
    protected $expeditionStatus;

    /**
     * @var ParcelObject[]
     */
    protected $parcels = [];

    /**
     * SamedayGetAwbStatusHistoryResponse constructor.
     *
     * @param SamedayGetAwbStatusHistoryRequest $request
     * @param SamedayRawResponse $rawResponse
     *
     * @throws Exception
     */
    public function __construct(SamedayGetAwbStatusHistoryRequest $request, SamedayRawResponse $rawResponse)
    {
        $this->request = $request;
        $this->rawResponse = $rawResponse;

        $json = json_decode($this->rawResponse->getBody(), true);
        if (!$json) {
            // Empty response.
            return;
        }

        $this->summary = new SummaryObject(
            $json['expeditionSummary']['delivered'],
            $json['expeditionSummary']['canceled'],
            $json['expeditionSummary']['deliveryAttempts'],
            $json['expeditionSummary']['awbNumber'],
            $json['expeditionSummary']['awbWeight'],
            $json['expeditionSummary']['servicePayment'],
            $json['expeditionSummary']['cashOnDelivery'],
            $json['expeditionSummary']['redirectionsAttempts'],
            $json['expeditionSummary']['deliveredAt'] ? new DateTime($json['expeditionSummary']['deliveredAt']) : null,
            $json['expeditionSummary']['lastDeliveryAttempt'] ? new DateTime($json['expeditionSummary']['lastDeliveryAttempt']) : null
        );

        foreach ($json['expeditionHistory'] as $history) {
            $this->history[] = $this->parseHistory($history);
        }

        foreach ($json['parcelsStatus'] as $parcel) {
            $this->parcels[] = $this->parseParcel($parcel);
        }

        $this->expeditionStatus = $this->parseExpedition($json['expeditionStatus']);
    }

    /**
     * @return SummaryObject
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @return HistoryObject[]
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * @return ExpeditionObject
     */
    public function getExpeditionStatus()
    {
        return $this->expeditionStatus;
    }

    /**
     * @return ParcelObject[]
     */
    public function getParcels()
    {
        return $this->parcels;
    }

    /**
     * @param array $json
     *
     * @return HistoryObject
     *
     * @throws Exception
     */
    private function parseHistory(array $json)
    {
        return new HistoryObject(
            $json['statusId'],
            $json['status'],
            $json['statusLabel'],
            $json['statusState'],
            new DateTime($json['statusDate']),
            $json['county'],
            $json['reason'],
            $json['transitLocation']
        );
    }

    /**
     * @param array $json
     *
     * @return ExpeditionObject
     *
     * @throws Exception
     */
    private function parseExpedition(array $json)
    {
        return new ExpeditionObject(
            $json['statusId'],
            $json['status'],
            $json['statusLabel'],
            $json['statusState'],
            new DateTime($json['statusDate']),
            $json['county'],
            $json['reason'],
            $json['transitLocation']
        );
    }

    /**
     * @param array $json
     *
     * @return ParcelObject
     *
     * @throws Exception
     */
    private function parseParcel(array $json)
    {
        return new ParcelObject(
            $json['statusId'],
            $json['status'],
            $json['statusLabel'],
            $json['statusState'],
            new DateTime($json['statusDate']),
            $json['county'],
            $json['reason'],
            $json['transitLocation'],
            $json['parcelAwbNumber']
        );
    }
}
