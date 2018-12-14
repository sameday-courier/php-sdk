<?php

namespace Sameday\Exceptions;

use Sameday\Http\SamedayRawResponse;
use Sameday\Http\SamedayRequest;

/**
 * Class SamedayBadRequestException
 *
 * @package Sameday
 */
class SamedayBadRequestException extends SamedayServerException
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @inheritdoc
     */
    public function __construct(SamedayRequest $request, SamedayRawResponse $rawResponse, $message = '', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($request, $rawResponse, $message, $code, $previous);

        $json = json_decode($rawResponse->getBody(), true);
        if ($message === '' && isset($json['message'])) {
            $this->message = $json['message'];
        }

        if (!$json) {
            return;
        }

        $this->parseErrors($json, []);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $json
     * @param array $keys
     *
     * @return void
     */
    private function parseErrors(array &$json, array $keys)
    {
        if (!empty($json['errors'])) {
            if (!empty($json['errors']['children'])) {
                foreach ($json['errors']['children'] as $child => $jsonData) {
                    $this->parseErrors($jsonData, array_merge($keys, [$child]));
                }

                return;
            }

            $this->errors[] = ['key' => $keys, 'errors' => $json['errors']];
        }

        if (!empty($json['children'])) {
            foreach ($json['children'] as $child => $jsonData) {
                $this->parseErrors($jsonData, array_merge($keys, [$child]));
            }
        }
    }
}
