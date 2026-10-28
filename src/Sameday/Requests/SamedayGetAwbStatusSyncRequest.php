<?php

namespace Sameday\Requests;

use Sameday\Http\SamedayRequest;
use Sameday\Requests\Traits\SamedayRequestPaginationTrait;

/**
 * Request to get AWB status transitions between two timestamps.
 *
 * Maximum interval between start and end is 2 hours. Results are paginated.
 *
 * @package Sameday
 */
class SamedayGetAwbStatusSyncRequest implements SamedayPaginatedRequestInterface
{
    use SamedayRequestPaginationTrait;

    /**
     * @var int
     */
    protected $startTimestamp;

    /**
     * @var int
     */
    protected $endTimestamp;

    /**
     * SamedayGetAwbStatusSyncRequest constructor.
     *
     * @param int $startTimestamp
     * @param int $endTimestamp
     */
    public function __construct($startTimestamp, $endTimestamp)
    {
        $this->startTimestamp = $startTimestamp;
        $this->endTimestamp = $endTimestamp;
        $this->setCountPerPage(500);
    }

    /**
     * @inheritdoc
     */
    public function buildRequest()
    {
        return new SamedayRequest(
            true,
            'GET',
            '/api/client/status-sync',
            array_merge(
                [
                    'startTimestamp' => $this->startTimestamp,
                    'endTimestamp' => $this->endTimestamp,
                ],
                $this->buildPagination()
            )
        );
    }

    /**
     * @return int
     */
    public function getStartTimestamp()
    {
        return $this->startTimestamp;
    }

    /**
     * @param int $startTimestamp
     *
     * @return $this
     */
    public function setStartTimestamp($startTimestamp)
    {
        $this->startTimestamp = $startTimestamp;

        return $this;
    }

    /**
     * @return int
     */
    public function getEndTimestamp()
    {
        return $this->endTimestamp;
    }

    /**
     * @param int $endTimestamp
     *
     * @return $this
     */
    public function setEndTimestamp($endTimestamp)
    {
        $this->endTimestamp = $endTimestamp;

        return $this;
    }
}
