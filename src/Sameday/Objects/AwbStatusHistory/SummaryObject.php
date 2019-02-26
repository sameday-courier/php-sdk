<?php

namespace Sameday\Objects\AwbStatusHistory;

/**
 * Summary for awb status.
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
     * @var float
     */
    protected $servicePayment;

    /**
     * @var string
     */
    protected $awbNumber;

    /**
     * @var float
     */
    protected $awbWeight;

    /**
     * @var float
     */
    protected $cashOnDelivery;

    /**
     * @var int
     */
    protected $redirectionAttempts;

    /**
     * SummaryObject constructor.
     *
     * @param bool $delivered
     * @param bool $canceled
     * @param int $deliveryAttempts
     * @param string $awbNumber
     * @param float $awbWeight
     * @param float $servicePayment
     * @param float $cashOnDelivery
     * @param int $redirectionAttempts
     * @param \DateTime|null $deliveredAt
     * @param \DateTime|null $lastDeliveryAttempt
     */
    public function __construct(
        $delivered,
        $canceled,
        $deliveryAttempts,
        $awbNumber,
        $awbWeight,
        $servicePayment,
        $cashOnDelivery,
        $redirectionAttempts = 0,
        \DateTime $deliveredAt = null,
        \DateTime $lastDeliveryAttempt = null
    ) {
        $this->delivered = $delivered;
        $this->canceled = $canceled;
        $this->deliveryAttempts = $deliveryAttempts;
        $this->awbNumber = $awbNumber;
        $this->awbWeight = $awbWeight;
        $this->servicePayment = $servicePayment;
        $this->cashOnDelivery = $cashOnDelivery;
        $this->redirectionAttempts = $redirectionAttempts;
        $this->deliveredAt = $deliveredAt ? clone $deliveredAt : null;
        $this->lastDeliveryAttempt = $lastDeliveryAttempt ? clone $lastDeliveryAttempt : null;
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
    public function getAwbNumber()
    {
        return $this->awbNumber;
    }

    /**
     * @return float
     */
    public function getAwbWeight()
    {
        return $this->awbWeight;
    }

    /**
     * @return float
     */
    public function getServicePayment()
    {
        return $this->servicePayment;
    }

    /**
     * @return float
     */
    public function getCashOnDelivery()
    {
        return $this->cashOnDelivery;
    }

    /**
     * @return int
     */
    public function getRedirectionAttempts()
    {
        return $this->redirectionAttempts;
    }
}
