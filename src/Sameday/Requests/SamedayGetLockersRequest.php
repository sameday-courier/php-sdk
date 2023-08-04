<?php

namespace Sameday\Requests;

use Sameday\Http\SamedayRequest;
use Sameday\Requests\Traits\SamedayRequestPaginationTrait;

/**
 * Request to get lockers list.
 *
 * @package Sameday
 */
class SamedayGetLockersRequest implements SamedayPaginatedRequestInterface
{
    use SamedayRequestPaginationTrait;

    /**
     * @var array
     */
    protected $lockerIds;

    /**
     * SamedayGetLockersRequest constructor.
     *
     * @param array $lockerIds
     */
    public function __construct(array $lockerIds = [])
    {
        $this->lockerIds = $lockerIds;
    }

    /**
     * @inheritdoc
     */
    public function buildRequest()
    {
        return new SamedayRequest(
            true,
            'GET',
            '/api/client/lockers',
            array_merge(
                count($this->lockerIds) > 0 ? ['lockersList' => implode(',', $this->lockerIds)] : [],
                $this->buildPagination()
            )
        );
    }

    /**
     * @return array
     */
    public function getLockerIds()
    {
        return $this->lockerIds;
    }

    /**
     * @param array $lockerIds
     *
     * @return $this
     */
    public function setLockerIds(array $lockerIds)
    {
        $this->lockerIds = $lockerIds;

        return $this;
    }
}
