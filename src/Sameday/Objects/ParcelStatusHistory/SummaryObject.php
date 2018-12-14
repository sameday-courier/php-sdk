<?php

namespace Sameday\Objects\ParcelStatusHistory;

/**
 * Summary for parcel status.
 *
 * @package Sameday
 */
class SummaryObject
{
    /**
     * @var \DateTime|null
     */
    protected $deliveredAt;

    /**
     * @var \DateTime|null
     */
    protected $lastDeliveryAttempt;

    /**
     * @var bool
     */
    protected $delivered;

    /**
     * @var bool
     */
    protected $canceled;

    /**
     * @var int
     */
    protected $deliveryAttempts;

    /**
     * @var string
     */
    protected $parcelAwbNumber;

    /**
     * @var float
     */
    protected $parcelWeight;

    /**
     * @var bool
     */
    protected $pickedUp;

    /**
     * @var \DateTime|null
     */
    protected $pickedUpAt;

    /**
     * SummaryObject constructor.
     *
     * @param bool $delivered
     * @param bool $canceled
     * @param int $deliveryAttempts
     * @param string $parcelAwbNumber
     * @param float $parcelWeight
     * @param bool $pickedUp
     * @param \DateTime|null $deliveredAt
     * @param \DateTime|null $lastDeliveryAttempt
     * @param \DateTime|null $pickedUpAt
     */
    public function __construct(
        $delivered,
        $canceled,
        $deliveryAttempts,
        $parcelAwbNumber,
        $parcelWeight,
        $pickedUp,
        \DateTime $deliveredAt = null,
        \DateTime $lastDeliveryAttempt = null,
        \DateTime $pickedUpAt = null
    ) {
        $this->delivered = $delivered;
        $this->canceled = $canceled;
        $this->deliveryAttempts = $deliveryAttempts;
        $this->parcelAwbNumber = $parcelAwbNumber;
        $this->parcelWeight = $parcelWeight;
        $this->pickedUp = $pickedUp;
        $this->deliveredAt = $deliveredAt ? clone $deliveredAt : null;
        $this->lastDeliveryAttempt = $lastDeliveryAttempt ? clone $lastDeliveryAttempt : null;
        $this->pickedUpAt = $pickedUpAt ? clone $pickedUpAt : null;
    }

    /**
     * @return \DateTime|null
     */
    public function getDeliveredAt()
    {
        return $this->deliveredAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getLastDeliveryAttempt()
    {
        return $this->lastDeliveryAttempt;
    }

    /**
     * @return bool
     */
    public function isDelivered()
    {
        return $this->delivered;
    }

    /**
     * @return bool
     */
    public function isCanceled()
    {
        return $this->canceled;
    }

    /**
     * @return int
     */
    public function getDeliveryAttempts()
    {
        return $this->deliveryAttempts;
    }

    /**
     * @return string
     */
    public function getParcelAwbNumber()
    {
        return $this->parcelAwbNumber;
    }

    /**
     * @return float
     */
    public function getParcelWeight()
    {
        return $this->parcelWeight;
    }

    /**
     * @return bool
     */
    public function isPickedUp()
    {
        return $this->pickedUp;
    }

    /**
     * @return \DateTime|null
     */
    public function getPickedUpAt()
    {
        return $this->pickedUpAt;
    }
}
