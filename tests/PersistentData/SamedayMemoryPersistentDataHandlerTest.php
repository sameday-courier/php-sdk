<?php

namespace Sameday\Tests\PersistentData;

use Sameday\PersistentData\SamedayMemoryPersistentDataHandler;

class SamedayMemoryPersistentDataHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testCanGetAndSetAVirtualValue()
    {
        $handler = new SamedayMemoryPersistentDataHandler();
        $handler->set('foo', 'bar');

        $this->assertEquals('bar', $handler->get('foo'));
    }

    public function testGettingAValueThatDoesntExistWillReturnNull()
    {
        $handler = new SamedayMemoryPersistentDataHandler();

        $this->assertNull($handler->get('does_not_exist'));
    }
}
