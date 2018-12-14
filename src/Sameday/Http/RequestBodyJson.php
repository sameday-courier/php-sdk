<?php

namespace Sameday\Http;

/**
 * Class that generates a JSON body for request.
 *
 * @package Sameday
 */
class RequestBodyJson implements RequestBodyInterface
{
    /**
     * @var array The parameters to send with this request.
     */
    protected $params = [];

    /**
     * RequestBodyJson constructor.
     *
     * @param array $params The parameters to be used when building the json body.
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
        return json_encode($this->params);
    }
}
