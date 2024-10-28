<?php

namespace Sameday\Http;

/**
 * Class that encapsulates a request to be sent.
 *
 * @package Sameday
 */
class SamedayRequest
{
    /**
     * Default request timeout.
     */
    const TIMEOUT = 10;

    /**
     * @var bool Does this request needs authentication?
     */
    protected $needAuth;

    /**
     * @var string The HTTP method to use (egs. GET, POST, PUT, DELETE).
     */
    protected $method;

    /**
     * @var string Endpoint URI.
     */
    protected $endpoint;

    /**
     * @var array Query parameters to append to URI endpoint.
     */
    protected $queryParams;

    /**
     * @var RequestBodyInterface|null Body of the request.
     */
    protected $body;

    /**
     * @var array HTTP headers to send with request.
     */
    protected $headers;

    /**
     * @var int Timeout in seconds.
     */
    protected $timeout;

    /**
     * SamedayRequest constructor.
     *
     * @param bool $needAuth Does this request needs authentication?
     * @param string $method The HTTP method to use.
     * @param string $endpoint Endpoint URI.
     * @param array $queryParams Query parameters to append to URI endpoint.
     * @param RequestBodyInterface|null $body Body of the request.
     * @param array $headers HTTP headers to send with request.
     * @param int $timeout Timeout for request in seconds.
     */
    public function __construct(
        $needAuth,
        $method,
        $endpoint,
        array $queryParams = [],
        RequestBodyInterface $body = null,
        array $headers = [],
        $timeout = self::TIMEOUT
    ) {
        $this->needAuth = $needAuth;
        $this->method = $method;
        $this->endpoint = $endpoint;
        $this->queryParams = $queryParams;
        $this->body = $body;
        $this->headers = $headers;
        $this->timeout = $timeout;
    }

    /**
     * Sets flag if this request needs authentication.
     *
     * @return bool
     */
    public function isNeedAuth()
    {
        return $this->needAuth;
    }

    /**
     * Does this request needs authentication?
     *
     * @param bool $needAuth
     *
     * @return SamedayRequest
     */
    public function setNeedAuth($needAuth)
    {
        $this->needAuth = $needAuth;

        return $this;
    }

    /**
     * Return the HTTP method used for this request.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the HTTP method used for this request.
     *
     * @param string $method
     *
     * @return SamedayRequest
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Return URI endpoint used for this request.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Set URI endpoint used for this request.
     *
     * @param string $endpoint
     *
     * @return SamedayRequest
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Return parameters to be appended to endpoint URI query string.
     *
     * @return array
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * Set parameters to append to endpoint URI query string.
     *
     * @param array $queryParams
     *
     * @return SamedayRequest
     */
    public function setQueryParams($queryParams)
    {
        $this->queryParams = $queryParams;

        return $this;
    }

    /**
     * Return body to be sent for this request.
     *
     * @return RequestBodyInterface|null
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the body to be sent for this request.
     *
     * @param RequestBodyInterface|null $body
     *
     * @return SamedayRequest
     */
    public function setBody(RequestBodyInterface $body = null)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Return the HTTP headers to be sent for this request.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set the HTTP headers to be sent for this request.
     *
     * @param array $headers
     *
     * @return SamedayRequest
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Return the timeout in seconds for this request.
     *
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Set timeout in seconds for this request.
     *
     * @param int $timeout
     *
     * @return SamedayRequest
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }
}
