# Sameday\Sameday

The `Sameday\Sameday` service class provides an easy interface for interacting with a client and make requests.

To instantiate a new `Sameday\Sameday` service, pass an instance of `Sameday\SamedayClientInterface` to the constructor.

```php
$sameday = new Sameday\Sameday($samedayClient);
```

Usage:

```php
// Get services for current user.
$services = $sameday->getServices(new Sameday\Requests\SamedayGetServicesRequest());

// Get pickup points for current user.
$response = $sameday->getPickupPoints(new Sameday\Requests\SamedayGetPickupPointsRequest());

// Delete an AWB.
$response = $sameday->deleteAwb(new Sameday\Requests\SamedayDeleteAwbRequest('{awb_number}'));
```
