# Sameday\SamedayClient

The `Sameday\SamedayClient` service class juggles the dependencies needed to make requests to the API. It automatically handles retrying and token refreshing for the requests.

To instantiate a new `Sameday\SamedayClient` service, you will need the assigned user and password for your Sameday Courier account.

## Constructor parameters

- `string $username` specifies the user to be used when making API calls
- `string $password` specifies the password for user to be used when making API calls
- `string|null $host [optional]` specifies the server host to be used when making API calls, for testing purposes
- `string|null $platformName [optional]` specifies the platform name to be sent to API (for logging purposes)
- `string|null $platformVersion [optional]` specifies the platform version to be sent to API (for logging purposes)
- `Sameday\HttpClients\SamedayHttpClientInterface|string|null $httpClientHandler [optional]` specifies the HTTP client handler to be used when making API calls
    - it can be overriden by specifying an implementation of `Sameday\HttpClients\SamedayHttpClientInterface`
    - you can pass a Guzzle5 `Client` instance
    - you can also use `'stream'`, `'curl'` or `'guzzle'` (default guzzle client)
    - by default it will autodetect in order specified above
- `SamedayPersistentDataInterface|string|null $persistentDataHandler [optional]` specifies the persistent data handler to be used when storing access tokens
    - it can be overriden by specifying an implementation of `Sameday\PersistentData\SamedayPersistentDataInterface`
    - pass `'session'` to use php `$_SESSION` (if session is enabled)
    - pass `'memory'` to use memory (token won't be saved between requests)
    - by default it will autodetect in order specified above
