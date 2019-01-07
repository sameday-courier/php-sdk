<?php

namespace Sameday\Objects\StatusSync;

use Sameday\Objects\Traits\SamedayObjectIdTrait;
use Sameday\Objects\Traits\SamedayObjectNameTrait;

/**
 * Status sync.
 *
 * @package Sameday
 */
class StatusObject
{
    use SamedayObjectIdTrait;
    use SamedayObjectNameTrait;

    /**
     * @var string
     */
    protected $parcelAwbNumber;

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
     * @var int
     */
    protected $reasonId;

    /**
     * @var string
     */
    protected $reason;

    /**
     * @var string
     */
    protected $details;

    /**
     * StatusObject constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $parcelAwbNumber
     * @param string $label
     * @param string $state
     * @param \DateTime $date
     * @param int $reasonId
     * @param string $reason
     * @param string $details
     */
    public function __construct(
        $id,
        $name,
        $parcelAwbNumber,
        $label,
        $state,
        \DateTime $date,
        $reasonId,
        $reason,
        $details
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->parcelAwbNumber = $parcelAwbNumber;
        $this->label = $label;
        $this->state = $state;
        $this->date = clone $date;
        $this->reasonId = $reasonId;
        $this->reason = $reason;
        $this->details = $details;
    }

    /**
     * @return string
     */
    public function getParcelAwbNumber()
    {
        return $this->parcelAwbNumber;
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
     * @return int
     */
    public function getReasonId()
    {
        return $this->reasonId;
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
    public function getDetails()
    {
        return $this->details;
    }
}
