<?php

namespace Sameday\Tests\PersistentData;

use PHPUnit\Framework\TestCase;
use Sameday\PersistentData\SamedayMemoryPersistentDataHandler;

class SamedayMemoryPersistentDataHandlerTest extends TestCase
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
