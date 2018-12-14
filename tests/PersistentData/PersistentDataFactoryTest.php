<?php

namespace Sameday\Tests\PersistentData;

use Sameday\PersistentData\SamedayMemoryPersistentDataHandler;
use Sameday\PersistentData\SamedaySessionPersistentDataHandler;
use Sameday\PersistentData\PersistentDataFactory;

class PersistentDataFactoryTest extends \PHPUnit_Framework_TestCase
{
    const COMMON_NAMESPACE = 'Sameday\PersistentData\\';
    const COMMON_INTERFACE = 'Sameday\PersistentData\SamedayPersistentDataInterface';

    /**
     * @param mixed $handler
     * @param string $expected
     *
     * @throws \Sameday\Exceptions\SamedaySDKException
     *
     * @dataProvider persistentDataHandlerProviders
     */
    public function testCreatePersistentDataHandler($handler, $expected)
    {
        $persistentDataHandler = PersistentDataFactory::createPersistentDataHandler($handler);

        $this->assertInstanceOf(self::COMMON_INTERFACE, $persistentDataHandler);
        $this->assertInstanceOf($expected, $persistentDataHandler);
    }

    /**
     * @return array
     *
     * @throws \Sameday\Exceptions\SamedaySDKException
     */
    public function persistentDataHandlerProviders()
    {
        $handlers = [
            ['memory', self::COMMON_NAMESPACE . 'SamedayMemoryPersistentDataHandler'],
            [new SamedayMemoryPersistentDataHandler(), self::COMMON_NAMESPACE . 'SamedayMemoryPersistentDataHandler'],
            [new SamedaySessionPersistentDataHandler(false), self::COMMON_NAMESPACE . 'SamedaySessionPersistentDataHandler'],
            [null, self::COMMON_INTERFACE],
        ];

        if (session_status() === PHP_SESSION_ACTIVE) {
            $handlers[] = ['session', self::COMMON_NAMESPACE . 'SamedaySessionPersistentDataHandler'];
        }

        return $handlers;
    }
}
