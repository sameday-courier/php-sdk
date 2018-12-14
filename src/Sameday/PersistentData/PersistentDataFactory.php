<?php

namespace Sameday\PersistentData;

use InvalidArgumentException;
use Sameday\Exceptions\SamedaySDKException;

/**
 * Factory to build a persistent data.
 *
 * @package Sameday
 */
class PersistentDataFactory
{
    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
        // A factory constructor should never be invoked.
    }

    /**
     * Persistent data handler generation.
     *
     * @param SamedayPersistentDataInterface|string|null $handler
     *
     * @throws InvalidArgumentException If the persistent data handler isn't "session", "memory", or an instance of Sameday\PersistentData\PersistentDataInterface.
     * @throws SamedaySDKException If session is used as persistent data handler but session is not active.
     *
     * @return SamedayPersistentDataInterface
     */
    public static function createPersistentDataHandler($handler)
    {
        if (!$handler) {
            return session_status() === PHP_SESSION_ACTIVE
                ? new SamedaySessionPersistentDataHandler()
                : new SamedayMemoryPersistentDataHandler();
        }

        if ($handler instanceof SamedayPersistentDataInterface) {
            return $handler;
        }

        if ('session' === $handler) {
            return new SamedaySessionPersistentDataHandler();
        }
        if ('memory' === $handler) {
            return new SamedayMemoryPersistentDataHandler();
        }

        throw new InvalidArgumentException('The persistent data handler must be set to "session", "memory", or be an instance of Sameday\PersistentData\PersistentDataInterface');
    }
}
