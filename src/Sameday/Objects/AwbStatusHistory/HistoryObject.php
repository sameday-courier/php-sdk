<?php

namespace Sameday\Objects\AwbStatusHistory;

use Sameday\Objects\Traits\SamedayObjectIdTrait;
use Sameday\Objects\Traits\SamedayObjectNameTrait;

/**
 * History for awb status.
 *
 * @package Sameday
 */
class HistoryObject
{
    use SamedayObjectIdTrait;
    use SamedayObjectNameTrait;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var string
     */
    protected $county;

    /**
     * @var string
     */
    protected $reason;

    /**
     * @var string
     */
    protected $transitLocation;

    /**
     * HistoryObject constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $label
     * @param string $state
     * @param \DateTime $date
     * @param string $county
     * @param string $reason
     * @param string $transitLocation
     */
    public function __construct(
        $id,
        $name,
        $label,
        $state,
        \DateTime $date,
        $county,
        $reason,
        $transitLocation
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->state = $state;
        $this->date = clone $date;
        $this->county = $county;
        $this->reason = $reason;
        $this->transitLocation = $transitLocation;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return string
     */
    public function getTransitLocation()
    {
        return $this->transitLocation;
    }
}
