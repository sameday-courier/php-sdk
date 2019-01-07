<?php

namespace Sameday\Objects\ParcelStatusHistory;

/**
 * Expedition for parcel status.
 *
 * @package Sameday
 */
class ExpeditionObject extends HistoryObject
{
    /**
     * @var string
     */
    protected $expeditionDetails;

    /**
     * ExpeditionObject constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $label
     * @param string $state
     * @param \DateTime $date
     * @param string $county
     * @param string $reason
     * @param string $transitLocation
     * @param string $expeditionDetails
     */
    public function __construct(
        $id,
        $name,
        $label,
        $state,
        \DateTime $date,
        $county,
        $reason,
        $transitLocation,
        $expeditionDetails
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

        $this->expeditionDetails = $expeditionDetails;
    }

    /**
     * @return string
     */
    public function getExpeditionDetails()
    {
        return $this->expeditionDetails;
    }
}
