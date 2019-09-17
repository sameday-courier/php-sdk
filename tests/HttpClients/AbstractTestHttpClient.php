<?php

namespace Sameday\Tests\HttpClients;

use PHPUnit_Framework_TestCase;

abstract class AbstractTestHttpClient extends PHPUnit_Framework_TestCase
{
    protected $fakeRawRedirectHeader = "HTTP/1.1 302 Found
Content-Type: text/html; charset=utf-8
Location: https://foobar.com/\r\n\r\n";
    protected $fakeRawProxyHeader = "HTTP/1.0 200 Connection established\r\n\r\n";
    protected $fakeRawProxyHeader2 = "HTTP/1.0 200 Connection established
Proxy-agent: Kerio Control/7.1.1 build 1971\r\n\r\n";
    protected $fakeRawHeader = "HTTP/1.1 200 OK
Content-Type: text/javascript; charset=UTF-8
Pragma: no-cache
Expires: Sat, 01 Jan 2000 00:00:00 GMT
Connection: close
Content-Length: 29
Cache-Control: private, no-cache, no-store, must-revalidate
Access-Control-Allow-Origin: *\r\n\r\n";
    protected $fakeRawBody = "{\"id\":\"123\",\"name\":\"Foo Bar\"}";
    protected $fakeHeadersAsArray = [
        'Content-Type' => 'text/javascript; charset=UTF-8',
        'Pragma' => 'no-cache',
        'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT',
        'Connection' => 'close',
        'Content-Length' => '29',
        'Cache-Control' => 'private, no-cache, no-store, must-revalidate',
        'Access-Control-Allow-Origin' => '*',
    ];
}
