# Sameday\Requests\SamedayPostParcelRequest

This entity represents a request to create a new parcel for an existing AWB.

## Constructor parameters

- `string $awbNumber` specifies the AWB number for which to add parcel
- `Sameday\Objects\ParcelDimensionsObject $parcelDimensionsObject` specifies the parcel dimensions
- `int $position` specified position of parcel to add
- `string|null $observation [optional]` specifies observations for new parcel
- `string|null $priceObservation [optional]` specifies price observations for new parcel 
- `bool $last [optional]` specifies whether this parcel is the last one and no more parcels will be added
