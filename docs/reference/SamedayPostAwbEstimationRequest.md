# Sameday\Requests\SamedayPostAwbEstimationRequest

This entity represents a request to calculate estimation cost for a new AWB.

## Constructor parameters

- `int $pickupPointId` specifies the pickup point id as returned by [`Sameday\Requests\SamedayGetPickupPointsRequest`](SamedayGetPickupPointsRequest.md)
- `int|null $contactPersonId` specifies the contact person id as returned by [`Sameday\Requests\SamedayGetPickupPointsRequest`](SamedayGetPickupPointsRequest.md)
- `Sameday\Objects\Types\PackageType $packageType` specifies the package type to be used
- `Sameday\Objects\PostAwb\Request\ParcelDimensionsObject[] $parcelsDimensions` specifies an array with parcels to be used
- `int $serviceId` specifies the service id as returned by [`Sameday\Requests\SamedayGetServicesRequest`](SamedayGetServicesRequest.md)
- `Sameday\Objects\Types\AwbPaymentType $awbPayment` specifies who will pay for the AWB 
- `Sameday\Objects\PostAwb\Request\AwbRecipientEntityObject` specifies the receiver of the package
- `float $insuredValue` specifies the insured value for the package
- `float $cashOnDeliveryAmount [optional]` specifies the cash value to be retrieved when delivering the package
- `Sameday\Objects\PostAwb\Request\ThirdPartyPickupEntityObject|null $thirdPartyPickup [optional]` specifies a third-party pickup point from where the package will pe picked-up
- `int[] $serviceTaxIds [optional]` specifies an array with delivery services that will be applied to this AWB
