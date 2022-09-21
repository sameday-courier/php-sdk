<?php

namespace Sameday\Http;

/**
 * Class that generates a URL encoded body for request.
 *
 * @package Sameday
 */
class RequestBodyUrlEncoded implements RequestBodyInterface
{
    /**
     * @var array The parameters to send with this request.
     */
    protected $params = [];

    /**
     * RequestBodyUrlEncoded constructor.
     *
     * @param array $params The parameters to be used when building the url encoded body.
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * @inheritdoc
     */
    public function getBody()
    {
        return http_build_query($this->params, '', '&');
    }
}
