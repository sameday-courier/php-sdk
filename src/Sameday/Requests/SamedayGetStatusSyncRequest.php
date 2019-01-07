<?php

namespace Sameday\Requests;

use Sameday\Http\SamedayRequest;
use Sameday\Requests\Traits\SamedayRequestPaginationTrait;

/**
 * Request to get status sync list.
 *
 * @package Sameday
 */
class SamedayGetStatusSyncRequest implements SamedayPaginatedRequestInterface
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
     * SamedayGetStatusSyncRequest constructor.
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
