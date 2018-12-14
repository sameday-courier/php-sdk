<?php

namespace Sameday\HttpClients;

/**
 * Abstraction for the procedural curl elements so that curl can be mocked and the implementation can be tested.
 *
 * @package Sameday
 */
class SamedayCurl
{
    /**
     * @var resource Curl resource instance.
     */
    protected $curl;

    /**
     * Make a new curl reference instance.
     *
     * @codeCoverageIgnore
     */
    public function init()
    {
        $this->curl = curl_init();
    }

    /**
     * Set a curl option.
     *
     * @param $key
     * @param $value
     *
     * @codeCoverageIgnore
     */
    public function setopt($key, $value)
    {
        curl_setopt($this->curl, $key, $value);
    }

    /**
     * Set an array of options to a curl resource.
     *
     * @param array $options
     *
     * @codeCoverageIgnore
     */
    public function setoptArray(array $options)
    {
        curl_setopt_array($this->curl, $options);
    }

    /**
     * Send a curl request.
     *
     * @return mixed
     *
     * @codeCoverageIgnore
     */
    public function exec()
    {
        return curl_exec($this->curl);
    }

    /**
     * Return the curl error number.
     *
     * @return int
     *
     * @codeCoverageIgnore
     */
    public function errno()
    {
        return curl_errno($this->curl);
    }

    /**
     * Return the curl error message.
     *
     * @return string
     *
     * @codeCoverageIgnore
     */
    public function error()
    {
        return curl_error($this->curl);
    }

    /**
     * Close the resource connection to curl.
     *
     * @codeCoverageIgnore
     */
    public function close()
    {
        curl_close($this->curl);
    }
}
