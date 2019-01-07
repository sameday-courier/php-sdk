# Sameday Courier SDK for PHP

[![Build Status](https://img.shields.io/travis/sameday-courier/php-sdk.svg)](https://travis-ci.org/sameday-courier/php-sdk)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/sameday-courier/php-sdk.svg)](https://scrutinizer-ci.com/g/sameday-courier/php-sdk/?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/sameday-courier/php-sdk.svg)](https://packagist.org/packages/sameday-courier/php-sdk)

This repository contains the open source PHP SDK that allows you to access the Sameday Courier Platform from your PHP app.

## Installation

The Sameday PHP SDK can be installed with [Composer](https://getcomposer.org/). Run this command:

```bash
$ composer require sameday-courier/php-sdk
```

## Usage

> **Note:** This version of the Sameday SDK for PHP requires PHP 5.4 or greater.

Simple GET example of a client's available services.

```php
require_once __DIR__ . '/vendor/autoload.php'; // Change path as needed.

// Initialization.
$samedayClient = new \Sameday\SamedayClient('user', 'password'); // Change user and password as needed for your account.
$sameday = new \Sameday\Sameday($samedayClient);

try {
    // Get services for delivery.
    $sameday->getServices(new \Sameday\Requests\SamedayGetServicesRequest());
} catch (\Sameday\Exceptions\SamedayServerException $e) {
    // When server returns an error.
    echo 'Server returned an error: ' . $e->getMessage();
    exit;
} catch (\Sameday\Exceptions\SamedaySDKException $e) {
    // When validation fails or other local issues.
    echo 'Sameday SDK returned an error: ' . $e->getMessage();
    exit;
}
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
