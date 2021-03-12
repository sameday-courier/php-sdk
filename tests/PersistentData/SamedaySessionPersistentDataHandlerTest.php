<?php

namespace Sameday\Tests\PersistentData;

use PHPUnit\Framework\TestCase;
use Sameday\Exceptions\SamedaySDKException;
use Sameday\PersistentData\SamedaySessionPersistentDataHandler;

class SamedaySessionPersistentDataHandlerTest extends TestCase
{
    /**
     * @expectedException \Sameday\Exceptions\SamedaySDKException
     */
    public function testInactiveSessionsWillThrow()
    {
        $this->expectException(SamedaySDKException::class);
        new SamedaySessionPersistentDataHandler();
    }

    /**
     * @throws \Sameday\Exceptions\SamedaySDKException
     */
    public function testCanSetAValue()
    {
        $handler = new SamedaySessionPersistentDataHandler(false);
        $handler->set('foo', 'bar');

        $this->assertEquals('bar', $_SESSION['SMD-COURIER_foo']);
    }

    /**
     * @throws \Sameday\Exceptions\SamedaySDKException
     */
    public function testCanGetAValue()
    {
        $_SESSION['SMD-COURIER_faz'] = 'baz';
        $handler = new SamedaySessionPersistentDataHandler(false);
        $value = $handler->get('faz');

        $this->assertEquals('baz', $value);
    }

    /**
     * @throws \Sameday\Exceptions\SamedaySDKException
     */
    public function testGettingAValueThatDoesntExistWillReturnNull()
    {
        $handler = new SamedaySessionPersistentDataHandler(false);
        $value = $handler->get('does_not_exist');

        $this->assertNull($value);
    }
}
