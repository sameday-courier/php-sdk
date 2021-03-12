<?php

namespace Sameday\Tests\Http;

use PHPUnit\Framework\TestCase;
use Sameday\Http\RequestBodyJson;

class RequestBodyJsonTest extends TestCase
{
    public function testCanProperlyEncodeAnArrayOfParams()
    {
        $message = new RequestBodyJson([
            'foo' => 'bar',
            'scawy_vawues' => '@FooBar is a real twitter handle.',
        ]);

        $this->assertEquals('{"foo":"bar","scawy_vawues":"@FooBar is a real twitter handle."}', $message->getBody());
    }

    public function testSupportsMultidimensionalParams()
    {
        $message = new RequestBodyJson([
            'foo' => 'bar',
            'faz' => [1,2,3],
            'targeting' => [
              'countries' => 'US,GB',
              'age_min' => 13,
            ],
            'call_to_action' => [
              'type' => 'LEARN_MORE',
              'value' => [
                'link' => 'http://example.com',
                'sponsorship' => [
                  'image' => 'http://example.com/bar.jpg',
                ],
              ],
            ],
        ]);

        $this->assertEquals('{"foo":"bar","faz":[1,2,3],"targeting":{"countries":"US,GB","age_min":13},"call_to_action":{"type":"LEARN_MORE","value":{"link":"http:\/\/example.com","sponsorship":{"image":"http:\/\/example.com\/bar.jpg"}}}}', $message->getBody());
    }
}
