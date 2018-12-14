<?php

namespace Sameday\Tests\Http;

use Sameday\Http\SamedayRawResponse;

class SamedayRawResponseTest extends \PHPUnit_Framework_TestCase
{
    protected $fakeRawProxyHeader = "HTTP/1.0 200 Connection established
Proxy-agent: Kerio Control/7.1.1 build 1971\r\n\r\n";
    protected $fakeRawHeader = <<<HEADER
HTTP/1.1 200 OK
Content-Type: text/html; charset=UTF-8
Access-Control-Allow-Origin: *\r\n\r\n
HEADER;
    protected $fakeHeadersAsArray = [
        'Content-Type' => 'text/html; charset=UTF-8',
        'Access-Control-Allow-Origin' => '*',
    ];

    protected $jsonFakeHeader = 'x-fb-ads-insights-throttle: {"app_id_util_pct": 0.00,"acc_id_util_pct": 0.00}';
    protected $jsonFakeHeaderAsArray = ['x-fb-ads-insights-throttle' => '{"app_id_util_pct": 0.00,"acc_id_util_pct": 0.00}'];

    public function testCanSetTheHeadersFromAnArray()
    {
        $headers = [
            'foo' => 'bar',
            'baz' => 'faz',
        ];
        $response = new SamedayRawResponse($headers, '');

        $this->assertEquals($response->getHeaders(), $headers);
    }

    public function testCanSetTheHeadersFromAString()
    {
        $response = new SamedayRawResponse($this->fakeRawHeader, '');

        $this->assertEquals($this->fakeHeadersAsArray, $response->getHeaders());
        $this->assertEquals(200, $response->getHttpStatusCode());
    }

    public function testWillIgnoreProxyHeaders()
    {
        $response = new SamedayRawResponse($this->fakeRawProxyHeader . $this->fakeRawHeader, '');

        $this->assertEquals($this->fakeHeadersAsArray, $response->getHeaders());
        $this->assertEquals(200, $response->getHttpStatusCode());
    }

    public function testCanTransformJsonHeaderValues()
    {
        $response = new SamedayRawResponse($this->jsonFakeHeader, '');
        $headers = $response->getHeaders();

        $this->assertEquals($this->jsonFakeHeaderAsArray['x-fb-ads-insights-throttle'], $headers['x-fb-ads-insights-throttle']);
    }
    
    public function testHttpResponseCode()
    {
        // HTTP/1.0
        $headers = str_replace('HTTP/1.1', 'HTTP/1.0', $this->fakeRawHeader);
        $response = new SamedayRawResponse($headers, '');
        $this->assertEquals(200, $response->getHttpStatusCode());
        
        // HTTP/1.1
        $response = new SamedayRawResponse($this->fakeRawHeader, '');
        $this->assertEquals(200, $response->getHttpStatusCode());
        
        // HTTP/2
        $headers = str_replace('HTTP/1.1', 'HTTP/2', $this->fakeRawHeader);
        $response = new SamedayRawResponse($headers, '');
        $this->assertEquals(200, $response->getHttpStatusCode());
    }
}
