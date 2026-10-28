<?php

namespace Sameday\Objects\AwbStatusSync;

use DateTime;
use Sameday\Objects\Traits\SamedayObjectIdTrait;
use Sameday\Objects\Traits\SamedayObjectNameTrait;

/**
 * AWB status sync entry.
 *
 * @package Sameday
 */
class StatusSyncObject
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
     * @var DateTime
     */
    protected $date;

    /**
     * @var string
     */
    protected $transitLocation;

    /**
     * @var int|null
     */
    protected $reasonId;

    /**
     * @var string
     */
    protected $reason;

    /**
     * @var int|null
     */
    protected $createdBy;

    /**
     * @var bool
     */
    protected $inReturn;

    /**
     * @var int|null
     */
    protected $itemsNo;

    /**
     * @var array
     */
    protected $lockerDetails;

    /**
     * @var array
     */
    protected $oohDetails;

    /**
     * @var int
     */
    protected $tobaccoCheck;

    /**
     * @var string
     */
    protected $parcelDetails;

    /**
     * @var DamageCheckObject|null
     */
    protected $damageCheck;

    /**
     * StatusSyncObject constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $parcelAwbNumber
     * @param string $label
     * @param string $state
     * @param DateTime $date
     * @param string $transitLocation
     * @param int|null $reasonId
     * @param string $reason
     * @param int|null $createdBy
     * @param bool $inReturn
     * @param int|null $itemsNo
     * @param array $lockerDetails
     * @param array $oohDetails
     * @param int $tobaccoCheck
     * @param string $parcelDetails
     * @param DamageCheckObject|null $damageCheck
     */
    public function __construct(
        $id,
        $name,
        $parcelAwbNumber,
        $label,
        $state,
        DateTime $date,
        $transitLocation,
        $reasonId,
        $reason,
        $createdBy,
        $inReturn,
        $itemsNo,
        array $lockerDetails,
        array $oohDetails,
        $tobaccoCheck,
        $parcelDetails,
        $damageCheck
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->parcelAwbNumber = $parcelAwbNumber;
        $this->label = $label;
        $this->state = $state;
        $this->date = clone $date;
        $this->transitLocation = $transitLocation;
        $this->reasonId = $reasonId;
        $this->reason = $reason;
        $this->createdBy = $createdBy;
        $this->inReturn = (bool) $inReturn;
        $this->itemsNo = $itemsNo;
        $this->lockerDetails = $lockerDetails;
        $this->oohDetails = $oohDetails;
        $this->tobaccoCheck = $tobaccoCheck;
        $this->parcelDetails = $parcelDetails;
        $this->damageCheck = $damageCheck;
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
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getTransitLocation()
    {
        return $this->transitLocation;
    }

    /**
     * @return int|null
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
     * @return int|null
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @return bool
     */
    public function isInReturn()
    {
        return $this->inReturn;
    }

    /**
     * @return int|null
     */
    public function getItemsNo()
    {
        return $this->itemsNo;
    }

    /**
     * @return array
     */
    public function getLockerDetails()
    {
        return $this->lockerDetails;
    }

    /**
     * @return array
     */
    public function getOohDetails()
    {
        return $this->oohDetails;
    }

    /**
     * @return int
     */
    public function getTobaccoCheck()
    {
        return $this->tobaccoCheck;
    }

    /**
     * @return string
     */
    public function getParcelDetails()
    {
        return $this->parcelDetails;
    }

    /**
     * @return DamageCheckObject|null
     */
    public function getDamageCheck()
    {
        return $this->damageCheck;
    }
}
