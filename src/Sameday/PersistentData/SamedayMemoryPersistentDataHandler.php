<?php

namespace Sameday\PersistentData;

/**
 * Class that encapsulates a persistent data handler in memory.
 *
 * @package Sameday
 */
class SamedayMemoryPersistentDataHandler implements SamedayPersistentDataInterface
{
    /**
     * @var array The data to keep in memory.
     */
    protected $data = [];

    /**
     * @inheritdoc
     */
    public function get($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    /**
     * @inheritdoc
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }
}
