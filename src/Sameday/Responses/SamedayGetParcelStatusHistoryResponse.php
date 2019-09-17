<?php

namespace Sameday\Responses;

use DateTime;
use Sameday\Http\SamedayRawResponse;
use Sameday\Objects\ParcelStatusHistory\ExpeditionObject;
use Sameday\Objects\ParcelStatusHistory\HistoryObject;
use Sameday\Objects\ParcelStatusHistory\SummaryObject;
use Sameday\Requests\SamedayGetParcelStatusHistoryRequest;
use Sameday\Responses\Traits\SamedayResponseTrait;

/**
 * Response for get parcel history request.
 *
 * @package Sameday
 */
class SamedayGetParcelStatusHistoryResponse implements SamedayResponseInterface
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
     * SamedayGetParcelStatusHistoryResponse constructor.
     *
     * @param SamedayGetParcelStatusHistoryRequest $request
     * @param SamedayRawResponse $rawResponse
     *
     * @throws \Exception
     */
    public function __construct(SamedayGetParcelStatusHistoryRequest $request, SamedayRawResponse $rawResponse)
    {
        $this->request = $request;
        $this->rawResponse = $rawResponse;

        $json = json_decode($this->rawResponse->getBody(), true);
        if (!$json) {
            // Empty response.
            return;
        }

        $this->summary = new SummaryObject(
            $json['parcelSummary']['delivered'],
            $json['parcelSummary']['canceled'],
            $json['parcelSummary']['deliveryAttempts'],
            $json['parcelSummary']['parcelAwbNumber'],
            $json['parcelSummary']['parcelWeight'],
            $json['parcelSummary']['isPickedUp'],
            $json['parcelSummary']['deliveredAt'] ? new DateTime($json['parcelSummary']['deliveredAt']) : null,
            $json['parcelSummary']['lastDeliveryAttempt'] ? new DateTime($json['parcelSummary']['lastDeliveryAttempt']) : null,
            $json['parcelSummary']['isPickedUp'] && $json['parcelSummary']['pickedUpAt'] ? new DateTime($json['parcelSummary']['pickedUpAt']) : null
        );

        foreach ($json['parcelHistory'] as $history) {
            $this->history[] = $this->parseHistory($history);
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
     * @param array $json
     *
     * @return HistoryObject
     *
     * @throws \Exception
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
     * @throws \Exception
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
            $json['transitLocation'],
            $json['expeditionDetails']
        );
    }
}
