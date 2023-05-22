<?php

namespace Sameday;

use DateTime;
use Exception;
use Sameday\Exceptions\SamedayAuthenticationException;
use Sameday\Exceptions\SamedayAuthorizationException;
use Sameday\Exceptions\SamedayBadRequestException;
use Sameday\Exceptions\SamedayNotFoundException;
use Sameday\Exceptions\SamedayOtherException;
use Sameday\Exceptions\SamedaySDKException;
use Sameday\Exceptions\SamedayServerException;
use Sameday\Http\SamedayRawResponse;
use Sameday\Http\SamedayRequest;
use Sameday\HttpClients\HttpClientsFactory;
use Sameday\HttpClients\SamedayHttpClientInterface;
use Sameday\PersistentData\PersistentDataFactory;
use Sameday\PersistentData\SamedayPersistentDataInterface;
use Sameday\Requests\SamedayAuthenticateRequest;
use Sameday\Responses\SamedayAuthenticateResponse;

/**
 * Class that handles HTTP request and response processing.
 *
 * @package Sameday
 */
class SamedayClient implements SamedayClientInterface
{
    const VERSION = '2.1.1';
    const API_HOST = 'https://api.sameday.ro';
    const KEY_TOKEN = 'token';
    const KEY_TOKEN_EXPIRES = 'expires_at';

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string|null
     */
    protected $platformName;

    /**
     * @var string|null
     */
    protected $platformVersion;

    /**
     * @var SamedayHttpClientInterface
     */
    protected $httpClientHandler;

    /**
     * @var SamedayPersistentDataInterface
     */
    protected $persistentDataHandler;

    /**
     * SamedayClient constructor.
     *
     * @param string $username
     * @param string $password
     * @param string|null $host
     * @param string|null $platformName
     * @param string|null $platformVersion
     * @param SamedayHttpClientInterface|string|null $httpClientHandler
     * @param SamedayPersistentDataInterface|string|null $persistentDataHandler
     *
     * @throws Exceptions\SamedaySDKException
     */
    public function __construct(
        $username,
        $password,
        $host = null,
        $platformName = null,
        $platformVersion = null,
        $httpClientHandler = null,
        $persistentDataHandler = null
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->host = $host ?: self::API_HOST;
        $this->platformName = $platformName;
        $this->platformVersion = $platformVersion;
        $this->httpClientHandler = HttpClientsFactory::createHttpClient($httpClientHandler);
        $this->persistentDataHandler = PersistentDataFactory::createPersistentDataHandler($persistentDataHandler);
    }

    /**
     * @inheritdoc
     */
    public function sendRequest(SamedayRequest $request)
    {
        $headers = $request->getHeaders();
        $headers['User-Agent'] = 'PHP-SDK/' . self::VERSION;

        if ($this->platformName !== null && $this->platformVersion !== null) {
            $headers['X-Platform'] = "{$this->platformName}/{$this->platformVersion}";
        }

        $try = 0;
        /** @var SamedayRawResponse $rawResponse */
        $rawResponse = null;

        $url = $this->host . $request->getEndpoint();
        if ($request->getQueryParams()) {
            $params = http_build_query($request->getQueryParams(), '', '&');
            if ($params !== '') {
                $url .= '?' . $params;
            }
        }

        while (++$try) {
            if ($request->isNeedAuth()) {
                $headers['X-AUTH-TOKEN'] = $this->getToken();
            }

            $rawResponse = $this->httpClientHandler->send(
                $url,
                $request->getMethod(),
                $request->getBody() ? $request->getBody()->getBody() : '',
                $headers,
                $request->getTimeout()
            );

            $statusCode = $rawResponse->getHttpStatusCode();

            if ($statusCode >= 200 && $statusCode < 300) {
                // Success.
                break;
            }

            if ($statusCode >= 500 && $statusCode < 600) {
                // Server error.
                throw new SamedayServerException($request, $rawResponse);
            }

            if ($try === 1 && in_array($statusCode, [401, 403], false) && $request->isNeedAuth()) {
                // First try and need auth, reset token.
                $this->logout();

                continue;
            }

            // Throw exceptions based on status code.
            switch ($statusCode) {
                case 400:
                    throw new SamedayBadRequestException($request, $rawResponse);

                case 401:
                    throw new SamedayAuthorizationException($request, $rawResponse);

                case 403:
                    throw new SamedayAuthenticationException($request, $rawResponse);

                case 404:
                    throw new SamedayNotFoundException($request, $rawResponse);
            }

            throw new SamedayOtherException($request, $rawResponse);
        }

        return $rawResponse;
    }

    /**
     * @inheritdoc
     */
    public function login()
    {
        try {
            $this->getToken(false);
        } catch (SamedayAuthenticationException $e) {
            return false;
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function logout()
    {
        $this->persistentDataHandler->set(self::KEY_TOKEN, null);
        $this->persistentDataHandler->set(self::KEY_TOKEN_EXPIRES, null);
    }

    /**
     * @param bool $usePersistentData
     *
     * @return string
     *
     * @throws SamedaySDKException
     * @throws SamedayAuthenticationException
     * @throws Exception
     */
    protected function getToken($usePersistentData = true)
    {
        if ($usePersistentData) {
            $token = $this->persistentDataHandler->get(self::KEY_TOKEN);
            $expiresAt = $this->persistentDataHandler->get(self::KEY_TOKEN_EXPIRES);

            // Check if token is valid and not expired.
            if ($token && $expiresAt) {
                $expiresAt = new DateTime($expiresAt);
                if ($expiresAt > new DateTime()) {
                    return $token;
                }
            }
        }

        // Check if username and password are set.
        if ((string) $this->username === '' || (string) $this->password === '') {
            throw new SamedaySDKException('Username or password not set.');
        }

        // No token found or expired, try to get new one.
        $authenticateRequest = new SamedayAuthenticateRequest($this->username, $this->password);
        $rawResponse = $this->sendRequest($authenticateRequest->buildRequest());
        $response = new SamedayAuthenticateResponse($authenticateRequest, $rawResponse);

        if ($usePersistentData) {
            $this->persistentDataHandler->set(self::KEY_TOKEN, $response->getToken());
            $this->persistentDataHandler->set(self::KEY_TOKEN_EXPIRES, $response->getExpiresAt()->format('Y-m-d H:i:s'));
        }

        return $response->getToken();
    }
}
