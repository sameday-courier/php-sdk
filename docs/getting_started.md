# Getting started with the Sameday Courier SDK for PHP

If you are trying to integrate your website with Sameday Courier, this SDK for PHP does all the heavy lifting for you making it as easy as possible.

## Autoloading & namespaces

The Sameday Courier SDK for PHP is coded in compliance with [PSR-4](http://www.php-fig.org/psr/psr-4/). This means it relies heavily on namespaces so that class files can be loaded for you automatically.

It would be advantageous to familiarize yourself with the concepts of [namespacing](http://php.net/manual/en/language.namespaces.rationale.php) and [autoloading](http://php.net/manual/en/function.spl-autoload-register.php) if you are not already acquainted with them.

## System requirements

- PHP 5.4 or greater
- [Composer](https://getcomposer.org/) *(optional)*

## Installing the Sameday Courier SDK for PHP

There are two methods to install the Sameday Courier SDK for PHP. The recommended installation method is by using [Composer](#installing-with-composer-recommended). If are unable to use Composer for your project, you can still [install the SDK manually](#manually-installing-if-you-really-have-to) by downloading the source files and including the autoloader.

## Installing with Composer (recommended)

[Composer](https://getcomposer.org/) is the recommended way to install the Sameday Courier SDK for PHP. Simply run the following in the root of your project.

```
composer require sameday-courier/php-sdk
```

Once you do this, composer will edit your `composer.json` file and download the latest version of the SDK and put it in the `/vendor/` directory.

Make sure to include the Composer autoloader at the top of your script.

```php
require_once __DIR__ . '/vendor/autoload.php';
```

## Manually installing (if you really have to)

First, download the source code and unzip it wherever you like in your project.

[Download the SDK for PHP](https://github.com/sameday-courier/php-sdk/releases)

Then include the autoloader provided in the SDK at the top of your script.

```php
require_once __DIR__ . '/path/to/php-sdk/src/Sameday/autoload.php';
```

The autoloader should be able to auto-detect the proper location of the source code.

### Keeping things tidy

The source code includes myriad files that aren't necessary for use in a production environment. If you'd like to strip out everything except the core files, follow this example.

>  For this example we'll assume the root of your website is `/var/html`.

After downloading the source code with the button above, extract the files in a temporary directory.

Move the folder `src/Sameday` to the root of your website installation or where ever you like to put third-party code. For this example we'll rename the `Sameday` directory to `sameday-php-sdk`.

The path the the core SDK files should now be located in `/var/html/sameday-php-sdk` and inside will also be the `autoload.php` file.

Assuming we have a script called `index.php` in the root of our web project, we need to include the autoloader at the top of our script.

```php
require_once __DIR__ . '/sameday-php-sdk/autoload.php';
```

If the autoloader is having trouble detecting the path to the source files, we can define the location of the source code before the `require_once` statement.

```php
define('SAMEDAY_PHP_SDK_SRC_DIR', __DIR__ . '/sameday-php-sdk/');
require_once __DIR__ . '/sameday-php-sdk/autoload.php';
```

## Configuration and setup

Before we can send requests to the Sameday Courier API, we need to load our app configuration into the `Sameday\SamedayClient` service.

```php
$samedayClient = new Sameday\SamedayClient('{user}', '{password}');
```

You'll need to replace the `{user}` and `{password}` with your Sameday Courier user and password.

Next, create a `Sameday\Sameday` service which ties all the components of the SDK for PHP together.

```php
$sameday = new Sameday\Sameday($samedayClient);
```

## Authentication and authorization

The SDK will automatically handle obtaining and storing of access token for current php session.

## Graph API

Once you have an instance of the `Sameday\Sameday` service, you can begin making calls to the Sameday Courier API.

In this example we will send a GET request to the Sameday Courier API endpoint to get available services for current client.

```php
$samedayClient = new Sameday\SamedayClient(/* . . . */);
$sameday = new Sameday\Sameday($samedayClient);

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

The methods from `Sameday\Sameday` service will return a response which could be paginated.

For a full list of all of the components that make up the SDK for PHP, see the [SDK for PHP reference page](reference.md).
