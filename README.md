# Sameday Courier SDK for PHP

[![Build Status](https://github.com/sameday-courier/php-sdk/actions/workflows/tests.yml/badge.svg)](https://github.com/sameday-courier/php-sdk/actions/workflows/tests.yml)
[![Latest Stable Version](https://img.shields.io/packagist/v/sameday-courier/php-sdk.svg)](https://packagist.org/packages/sameday-courier/php-sdk)

This repository contains the open source PHP SDK that allows you to access the Sameday Courier Platform from your PHP app. It was inspired by Facebook PHP-SDK.

## Installation

The Sameday PHP SDK can be installed with [Composer](https://getcomposer.org/). Run this command:

```bash
$ composer require sameday-courier/php-sdk
```

## Usage

> **Note:** This version of the Sameday SDK for PHP requires PHP 5.4 or greater.

Simple example to get available pickup points and services for a client, request a new AWB and download the PDF for it.

```php
require_once __DIR__ . '/vendor/autoload.php'; // Change path as needed.

// Initialization. Change user and password as needed for your account. For testing purposes (also implies different user/password) set a third parameter to 'https://sameday-api.demo.zitec.com'.
$samedayClient = new \Sameday\SamedayClient('user', 'password');
$sameday = new \Sameday\Sameday($samedayClient);

// Get list of available pickup points for client.
$pickupPoints = $sameday->getPickupPoints(new \Sameday\Requests\SamedayGetPickupPointsRequest());
// Use first found pickup point id. These ids are different for DEMO and PROD environments. This id can be cached on your application.
$pickupPointId = $pickupPoints->getPickupPoints()[0]->getId();

// Get list of available services for client.
$services = $sameday->getServices(new \Sameday\Requests\SamedayGetServicesRequest());
// Use first service id. These ids are different for DEMO and PROD environments. This id can be cached on your application.
// This is just for example purpose. Choose the right service for your app.
// For instance if requesting with 2H service (delivery in 2 hours) and cities are different (pickup point city and recipient city) then the validation will fail.
$serviceId = $services->getServices()[0]->getId();

try {
    $awb = $sameday->postAwb(new \Sameday\Requests\SamedayPostAwbRequest(
        $pickupPointId,
        null, // Contact person id can be left to NULL and default will be used.
        new \Sameday\Objects\Types\PackageType(\Sameday\Objects\Types\PackageType::PARCEL),
        [
            // This will generate an AWB expedition with 2 parcels (packages). Only the $weight is mandatory.
            new \Sameday\Objects\ParcelDimensionsObject(0.5),
            new \Sameday\Objects\ParcelDimensionsObject(3, 15, 28, 67)
        ],
        $serviceId,
        new \Sameday\Objects\Types\AwbPaymentType(\Sameday\Objects\Types\AwbPaymentType::CLIENT), // Who pays for the AWB. CLIENT is the only allowed value.
        new \Sameday\Objects\PostAwb\Request\AwbRecipientEntityObject('Huedin', 'Cluj', 'str. Otesani', 'Nume Destinatar', '0700111111', 'destinatar.colet@gmail.com', new \Sameday\Objects\PostAwb\Request\CompanyEntityObject('nume companie SRL')), // AWB recipient. Please note that CompanyEntityObject is optional if the recipient is not company.
        0, // Insured value.
        100 // Cash on delivery value. Can be 0 if the payment was made online.
        // Other parameters may follow, see https://github.com/sameday-courier/php-sdk/blob/master/docs/reference/SamedayPostAwbRequest.md
    ));
} catch (\Sameday\Exceptions\SamedayBadRequestException $e) {
    // When request fails validation. Show the list of validation errors.
    var_dump($e->getErrors());
    exit;
} // Other exceptions may be thrown, see https://github.com/sameday-courier/php-sdk/blob/master/docs/reference.md#core-exceptions

$pdf = $sameday->getAwbPdf(new \Sameday\Requests\SamedayGetAwbPdfRequest($awb->getAwbNumber(), new \Sameday\Objects\Types\AwbPdfType(\Sameday\Objects\Types\AwbPdfType::A6)));
echo $pdf->getPdf();
```

Complete documentation, installation instructions, and examples are available [here](docs/).

## Tests

1. [Composer](https://getcomposer.org/) is a prerequisite for running the tests. Install composer globally, then run `composer install` to install required files.
2. The tests can be executed by running this command from the root directory:

```bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/sameday-courier/php-sdk/blob/master/CONTRIBUTING.md) for details.

## License

Please see the [license file](https://github.com/sameday-courier/php-sdk/blob/master/LICENSE) for more information.
