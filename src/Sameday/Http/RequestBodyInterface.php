<?php

namespace Sameday\Http;

/**
 * Interface that encapsulates a body for HTTP requests.
 *
 * @package Sameday
 */
interface RequestBodyInterface
{
    /**
     * Return the body of the request to send.
     *
     * @return string
     */
    public function getBody();
}
