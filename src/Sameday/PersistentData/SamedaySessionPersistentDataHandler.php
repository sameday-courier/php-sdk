<?php

namespace Sameday\PersistentData;

use Sameday\Exceptions\SamedaySDKException;

/**
 * Class that encapsulates a persistent data handler in php session.
 *
 * @package Sameday
 */
class SamedaySessionPersistentDataHandler implements SamedayPersistentDataInterface
{
    /**
     * @var string Prefix to use for session variables.
     */
    protected $sessionPrefix = 'SMD-COURIER_';

    /**
     * Init the session handler.
     *
     * @param boolean $enableSessionCheck
     *
     * @throws SamedaySDKException
     */
    public function __construct($enableSessionCheck = true)
    {
        if ($enableSessionCheck && session_status() !== PHP_SESSION_ACTIVE) {
            throw new SamedaySDKException('Sessions are not active. Please make sure session_start() is at the top of your script.');
        }
    }

    /**
     * @inheritdoc
     */
    public function get($key)
    {
        $sessionKey = $this->sessionPrefix . $key;

        return isset($_SESSION[$sessionKey]) ? $_SESSION[$sessionKey] : null;
    }

    /**
     * @inheritdoc
     */
    public function set($key, $value)
    {
        $_SESSION[$this->sessionPrefix . $key] = $value;
    }
}
