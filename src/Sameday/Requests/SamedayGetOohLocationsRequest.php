<?php

namespace Sameday\Requests;

use Sameday\Http\SamedayRequest;
use Sameday\Requests\Traits\SamedayRequestPaginationTrait;

/**
 * Request to get ooh locations list.
 *
 * @package Sameday
 */
class SamedayGetOohLocationsRequest implements SamedayPaginatedRequestInterface
{
    use SamedayRequestPaginationTrait;

    /**
     * @var array
     */
    protected $locationsIds;

    /**
     * @param array $locationsIds
     */
    public function __construct(array $locationsIds = [])
    {
        $this->locationsIds = $locationsIds;
    }

    /**
     * @inheritdoc
     */
    public function buildRequest()
    {
        return new SamedayRequest(
            true,
            'GET',
            '/api/client/ooh-locations',
            array_merge(
                count($this->locationsIds) > 0 ? ['locationsList' => implode(',', $this->locationsIds)] : [],
                $this->buildPagination()
            )
        );
    }

    /**
     * @return array
     */
    public function getLocationsIds()
    {
        return $this->locationsIds;
    }

    /**
     * @param array $locationsIds
     *
     * @return $this
     */
    public function setLocationsIds(array $locationsIds)
    {
        $this->locationsIds = $locationsIds;

        return $this;
    }
}
