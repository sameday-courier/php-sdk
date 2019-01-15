<?php

namespace Sameday\Requests;

use Sameday\Http\RequestBodyUrlEncoded;
use Sameday\Http\SamedayRequest;
use Sameday\Objects\ParcelDimensionsObject;
use Sameday\Objects\PostAwb\Request\AwbRecipientEntityObject;
use Sameday\Objects\PostAwb\Request\ThirdPartyPickupEntityObject;
use Sameday\Objects\Types\AwbPaymentType;
use Sameday\Objects\Types\CodCollectorType;
use Sameday\Objects\Types\DeliveryIntervalServiceType;
use Sameday\Objects\Types\PackageType;

/**
 * Request to create a new AWB.
 *
 * @package Sameday
 */
class SamedayPostAwbRequest implements SamedayRequestInterface
{
    /**
     * @var int
     */
    protected $pickupPointId;

    /**
     * @var int|null
     */
    protected $contactPersonId;

    /**
     * @var PackageType
     */
    protected $packageType;

    /**
     * @var ParcelDimensionsObject[]
     */
    protected $parcelsDimensions;

    /**
     * @var int
     */
    protected $serviceId;

    /**
     * @var AwbPaymentType
     */
    protected $awbPayment;

    /**
     * @var AwbRecipientEntityObject
     */
    protected $awbRecipient;

    /**
     * @var float
     */
    protected $insuredValue;

    /**
     * @var float
     */
    protected $cashOnDeliveryAmount;

    /**
     * @var CodCollectorType|null
     */
    protected $cashOnDeliveryCollector;

    /**
     * @var ThirdPartyPickupEntityObject|null
     */
    protected $thirdPartyPickup;

    /**
     * @var int[]
     */
    protected $serviceTaxIds;

    /**
     * @var DeliveryIntervalServiceType|null
     */
    protected $deliveryIntervalServiceType;

    /**
     * @var string|null
     */
    protected $reference;

    /**
     * @var string|null
     */
    protected $observation;

    /**
     * @var string|null
     */
    protected $priceObservation;

    /**
     * @var string|null
     */
    protected $clientObservation;

    /**
     * SamedayPostAwbRequest constructor.
     *
     * @param int $pickupPointId
     * @param int|null $contactPersonId
     * @param PackageType $packageType
     * @param ParcelDimensionsObject[] $parcelsDimensions
     * @param int $serviceId
     * @param AwbPaymentType $awbPayment
     * @param AwbRecipientEntityObject $awbRecipient
     * @param float $insuredValue
     * @param float $cashOnDeliveryAmount
     * @param CodCollectorType|null $cashOnDeliveryCollector
     * @param ThirdPartyPickupEntityObject|null $thirdPartyPickup
     * @param int[] $serviceTaxIds
     * @param DeliveryIntervalServiceType|null $deliveryIntervalServiceType
     * @param string|null $reference
     * @param string|null $observation
     * @param string|null $priceObservation
     * @param string|null $clientObservation
     */
    public function __construct(
        $pickupPointId,
        $contactPersonId,
        PackageType $packageType,
        array $parcelsDimensions,
        $serviceId,
        AwbPaymentType $awbPayment,
        AwbRecipientEntityObject $awbRecipient,
        $insuredValue,
        $cashOnDeliveryAmount = .0,
        CodCollectorType $cashOnDeliveryCollector = null,
        ThirdPartyPickupEntityObject $thirdPartyPickup = null,
        array $serviceTaxIds = [],
        DeliveryIntervalServiceType $deliveryIntervalServiceType = null,
        $reference = null,
        $observation = null,
        $priceObservation = null,
        $clientObservation = null
    ) {
        $this->pickupPointId = $pickupPointId;
        $this->contactPersonId = $contactPersonId;
        $this->packageType = $packageType;
        $this->parcelsDimensions = $parcelsDimensions;
        $this->serviceId = $serviceId;
        $this->awbPayment = $awbPayment;
        $this->awbRecipient = $awbRecipient;
        $this->insuredValue = $insuredValue;
        $this->cashOnDeliveryAmount = $cashOnDeliveryAmount;
        $this->cashOnDeliveryCollector = $cashOnDeliveryCollector;
        $this->thirdPartyPickup = $thirdPartyPickup;
        $this->serviceTaxIds = $serviceTaxIds;
        $this->deliveryIntervalServiceType = $deliveryIntervalServiceType;
        $this->reference = $reference;
        $this->observation = $observation;
        $this->priceObservation = $priceObservation;
        $this->clientObservation = $clientObservation;
    }

    /**
     * @inheritdoc
     */
    public function buildRequest()
    {
        // Calculate weight for all parcels.
        $weight = 0;
        array_map(
            function (ParcelDimensionsObject $parcelDimensions) use (&$weight) {
                $weight += $parcelDimensions->getWeight();
            },
            $this->parcelsDimensions
        );

        $body = [
            'pickupPoint' => $this->pickupPointId,
            'contactPerson' => $this->contactPersonId,
            'packageType' => $this->packageType->getType(),
            'packageNumber' => count($this->parcelsDimensions),
            'packageWeight' => $weight,
            'service' => $this->serviceId,
            'awbPayment' => $this->awbPayment->getType(),
            'cashOnDelivery' => $this->cashOnDeliveryAmount,
            'cashOnDeliveryReturns' => $this->cashOnDeliveryCollector ? $this->cashOnDeliveryCollector->getType() : null,
            'insuredValue' => $this->insuredValue,
            'thirdPartyPickup' => $this->thirdPartyPickup ? 1 : 0,
        ];

        // Third party pickup.
        if ($this->thirdPartyPickup !== null) {
            $body = array_merge($body, ['thirdParty' => $this->thirdPartyPickup->getFields()]);
        }

        $body = array_merge($body, [
            'serviceTaxes' => $this->serviceTaxIds,
            'deliveryInterval' => $this->deliveryIntervalServiceType ? $this->deliveryIntervalServiceType->getType() : null,
            'awbRecipient' => $this->awbRecipient->getFields(),
            'parcels' => array_map(
                // Build parcel fields from ParcelDimensionsObject.
                function (ParcelDimensionsObject $parcelDimensions) {
                    return [
                        'weight' => $parcelDimensions->getWeight(),
                        'width' => $parcelDimensions->getWidth(),
                        'length' => $parcelDimensions->getLength(),
                        'height' => $parcelDimensions->getHeight(),
                    ];
                },
                $this->parcelsDimensions
            ),
            'observation' => $this->observation,
            'priceObservation' => $this->priceObservation,
            'clientInternalReference' => $this->reference,
            'clientObservation' => $this->clientObservation,
        ]);

        return new SamedayRequest(
            true,
            'POST',
            '/api/awb',
            [],
            new RequestBodyUrlEncoded($body)
        );
    }

    /**
     * @return int
     */
    public function getPickupPointId()
    {
        return $this->pickupPointId;
    }

    /**
     * @param int $pickupPointId
     *
     * @return $this
     */
    public function setPickupPointId($pickupPointId)
    {
        $this->pickupPointId = $pickupPointId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getContactPersonId()
    {
        return $this->contactPersonId;
    }

    /**
     * @param int|null $contactPersonId
     *
     * @return $this
     */
    public function setContactPersonId($contactPersonId)
    {
        $this->contactPersonId = $contactPersonId;

        return $this;
    }

    /**
     * @return PackageType
     */
    public function getPackageType()
    {
        return $this->packageType;
    }

    /**
     * @param PackageType $packageType
     *
     * @return $this
     */
    public function setPackageType(PackageType $packageType)
    {
        $this->packageType = $packageType;

        return $this;
    }

    /**
     * @return ParcelDimensionsObject[]
     */
    public function getParcelsDimensions()
    {
        return $this->parcelsDimensions;
    }

    /**
     * @param ParcelDimensionsObject[] $parcelsDimensions
     *
     * @return $this
     */
    public function setParcelsDimensions($parcelsDimensions)
    {
        $this->parcelsDimensions = $parcelsDimensions;

        return $this;
    }

    /**
     * @return int
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * @param int $serviceId
     *
     * @return $this
     */
    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;

        return $this;
    }

    /**
     * @return AwbPaymentType
     */
    public function getAwbPayment()
    {
        return $this->awbPayment;
    }

    /**
     * @param AwbPaymentType $awbPayment
     *
     * @return $this
     */
    public function setAwbPayment(AwbPaymentType $awbPayment)
    {
        $this->awbPayment = $awbPayment;

        return $this;
    }

    /**
     * @return AwbRecipientEntityObject
     */
    public function getAwbRecipient()
    {
        return $this->awbRecipient;
    }

    /**
     * @param AwbRecipientEntityObject $awbRecipient
     *
     * @return $this
     */
    public function setAwbRecipient(AwbRecipientEntityObject $awbRecipient)
    {
        $this->awbRecipient = $awbRecipient;

        return $this;
    }

    /**
     * @return float
     */
    public function getInsuredValue()
    {
        return $this->insuredValue;
    }

    /**
     * @param float $insuredValue
     *
     * @return $this
     */
    public function setInsuredValue($insuredValue)
    {
        $this->insuredValue = $insuredValue;

        return $this;
    }

    /**
     * @return float
     */
    public function getCashOnDeliveryAmount()
    {
        return $this->cashOnDeliveryAmount;
    }

    /**
     * @param float $cashOnDeliveryAmount
     *
     * @return $this
     */
    public function setCashOnDeliveryAmount($cashOnDeliveryAmount)
    {
        $this->cashOnDeliveryAmount = $cashOnDeliveryAmount;

        return $this;
    }

    /**
     * @return CodCollectorType|null
     */
    public function getCashOnDeliveryCollector()
    {
        return $this->cashOnDeliveryCollector;
    }

    /**
     * @param CodCollectorType|null $cashOnDeliveryCollector
     *
     * @return $this
     */
    public function setCashOnDeliveryCollector(CodCollectorType $cashOnDeliveryCollector)
    {
        $this->cashOnDeliveryCollector = $cashOnDeliveryCollector;

        return $this;
    }

    /**
     * @return ThirdPartyPickupEntityObject|null
     */
    public function getThirdPartyPickup()
    {
        return $this->thirdPartyPickup;
    }

    /**
     * @param ThirdPartyPickupEntityObject|null $thirdPartyPickup
     *
     * @return $this
     */
    public function setThirdPartyPickup(ThirdPartyPickupEntityObject $thirdPartyPickup)
    {
        $this->thirdPartyPickup = $thirdPartyPickup;

        return $this;
    }

    /**
     * @return int[]
     */
    public function getServiceTaxIds()
    {
        return $this->serviceTaxIds;
    }

    /**
     * @param int[] $serviceTaxIds
     *
     * @return $this
     */
    public function setServiceTaxIds($serviceTaxIds)
    {
        $this->serviceTaxIds = $serviceTaxIds;

        return $this;
    }

    /**
     * @return DeliveryIntervalServiceType|null
     */
    public function getDeliveryIntervalServiceType()
    {
        return $this->deliveryIntervalServiceType;
    }

    /**
     * @param DeliveryIntervalServiceType|null $deliveryIntervalServiceType
     *
     * @return $this
     */
    public function setDeliveryIntervalServiceType(DeliveryIntervalServiceType $deliveryIntervalServiceType)
    {
        $this->deliveryIntervalServiceType = $deliveryIntervalServiceType;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string|null $reference
     *
     * @return $this
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * @param string|null $observation
     *
     * @return $this
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPriceObservation()
    {
        return $this->priceObservation;
    }

    /**
     * @param string|null $priceObservation
     *
     * @return $this
     */
    public function setPriceObservation($priceObservation)
    {
        $this->priceObservation = $priceObservation;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getClientObservation()
    {
        return $this->clientObservation;
    }

    /**
     * @param string|null $clientObservation
     *
     * @return $this
     */
    public function setClientObservation($clientObservation)
    {
        $this->clientObservation = $clientObservation;

        return $this;
    }
}
