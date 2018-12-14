<?php

namespace Sameday\Tests\PersistentData;

use Sameday\PersistentData\SamedaySessionPersistentDataHandler;

class SamedaySessionPersistentDataHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Sameday\Exceptions\SamedaySDKException
     */
    public function testInactiveSessionsWillThrow()
    {
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
