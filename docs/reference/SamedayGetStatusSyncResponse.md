# Sameday\Requests\SamedayGetStatusSyncResponse

This entity represents a response to get all status updated between two given UNIX timestamps (paginated).

## Public methods

| Method | Description |
| ------------- | ------------- |
| `string getAwbNumber()` | Get the AWB number |
| `float getCost()` | Get the cost for AWB |
| `Sameday\Objects\PostAwb\ParcelObject[] getParcels()` | Get the generated parcels for AWB |
| `string getPdfLink()` | Get the pdf link for AWB |
