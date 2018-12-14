<?php

namespace Sameday\PersistentData;

/**
 * Interface that encapsulates a handler for storing persistent data.
 *
 * @package Sameday
 */
interface SamedayPersistentDataInterface
{
    /**
     * Get a value from a persistent data store.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key);

    /**
     * Set a value in the persistent data store.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value);
}
