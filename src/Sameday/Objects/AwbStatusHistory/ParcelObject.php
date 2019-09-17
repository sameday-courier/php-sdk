<?php

namespace Sameday\Objects\AwbStatusHistory;

use DateTime;

/**
 * Parcel for awb status.
 *
 * @package Sameday
 */
class ParcelObject extends HistoryObject
{
    /**
     * @var string
     */
    protected $parcelAwbNumber;

    /**
     * ParcelObject constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $label
     * @param string $state
     * @param DateTime $date
     * @param string $county
     * @param string $reason
     * @param string $transitLocation
     * @param string $parcelAwbNumber
     */
    public function __construct(
        $id,
        $name,
        $label,
        $state,
        DateTime $date,
        $county,
        $reason,
        $transitLocation,
        $parcelAwbNumber
    ) {
        parent::__construct(
            $id,
            $name,
            $label,
            $state,
            $date,
            $county,
            $reason,
            $transitLocation
        );

        $this->parcelAwbNumber = $parcelAwbNumber;
    }

    /**
     * @return string
     */
    public function getParcelAwbNumber()
    {
        return $this->parcelAwbNumber;
    }
}
