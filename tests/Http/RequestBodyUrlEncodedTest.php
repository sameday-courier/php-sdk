<?php

namespace Sameday\Tests\Http;

use PHPUnit_Framework_TestCase;
use Sameday\Http\RequestBodyUrlEncoded;

class RequestBodyUrlEncodedTest extends PHPUnit_Framework_TestCase
{
    public function testCanProperlyEncodeAnArrayOfParams()
    {
        $message = new RequestBodyUrlEncoded([
            'foo' => 'bar',
            'scawy_vawues' => '@FooBar is a real twitter handle.',
        ]);

        $this->assertEquals('foo=bar&scawy_vawues=%40FooBar+is+a+real+twitter+handle.', $message->getBody());
    }

    public function testSupportsMultidimensionalParams()
    {
        $message = new RequestBodyUrlEncoded([
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

        $this->assertEquals('foo=bar&faz%5B0%5D=1&faz%5B1%5D=2&faz%5B2%5D=3&targeting%5Bcountries%5D=US%2CGB&targeting%5Bage_min%5D=13&call_to_action%5Btype%5D=LEARN_MORE&call_to_action%5Bvalue%5D%5Blink%5D=http%3A%2F%2Fexample.com&call_to_action%5Bvalue%5D%5Bsponsorship%5D%5Bimage%5D=http%3A%2F%2Fexample.com%2Fbar.jpg', $message->getBody());
    }
}
