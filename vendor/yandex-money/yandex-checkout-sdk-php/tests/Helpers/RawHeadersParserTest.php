<?php


use PHPUnit\Framework\TestCase;
use YandexCheckout\Helpers\RawHeadersParser;

class RawHeadersParserTest extends TestCase
{
    /**
     * @dataProvider headersDataProvider
     */
    public function testParse($rawHeaders, $expected)
    {
        $this->assertEquals($expected, RawHeadersParser::parse($rawHeaders));
    }

    public function headersDataProvider()
    {
        return array(
            array(
                'Server: nginx
                Date: Thu, 03 Aug 2017 16:04:35 GMT
                Content-Type: text/html
                Content-Length: 178
                Connection: keep-alive
                Location: https://insales-dev.yamoney.ru/',
                array(
                    'Server' => 'nginx',
                    'Date' => 'Thu, 03 Aug 2017 16:04:35 GMT',
                    'Content-Type' => 'text/html',
                    'Content-Length' => '178',
                    'Connection' => 'keep-alive',
                    'Location' => 'https://insales-dev.yamoney.ru/'
                ),
            ),
            array(
                "HTTP/1.1 200 Ok\r\n" .
                "Server: nginx\r\n" .
                "Date: Thu, 03 Aug 2017 16:04:35 GMT\r\n" .
                "Content-Type: text/html\r\n" .
                "Content-Length: 178\r\n" .
                "Array-Header: value1\r\n" .
                "Connection: keep-alive\r\n" .
                "Array-Header: value2\r\n" .
                "Location: https://insales-dev.yamoney.ru/\r\n" .
                "\r\n" .
                "Content-Length: 132",
                array(
                    0 => 'HTTP/1.1 200 Ok',
                    'Server' => 'nginx',
                    'Date' => 'Thu, 03 Aug 2017 16:04:35 GMT',
                    'Content-Type' => 'text/html',
                    'Content-Length' => '178',
                    'Array-Header' => array(
                        'value1', 'value2'
                    ),
                    'Connection' => 'keep-alive',
                    'Location' => 'https://insales-dev.yamoney.ru/'
                ),
            ),
            array(
                "HTTP/1.1 200 Ok\r\n" .
                "Server: nginx\r\n" .
                "\tversion 1.3.4\r\n" .
                "Date: Thu, 03 Aug 2017 16:04:35 GMT\r\n" .
                "Content-Type: text/html\r\n" .
                "Content-Length: 178\r\n" .
                "Array-Header: value1\r\n" .
                "Connection: keep-alive\r\n" .
                "Array-Header: value2\r\n" .
                "Location: https://insales-dev.yamoney.ru/\r\n" .
                "Array-Header: value3\r\n" .
                "\r\n" .
                "Content-Length: 132",
                array(
                    0 => 'HTTP/1.1 200 Ok',
                    'Server' => "nginx\r\n\tversion 1.3.4",
                    'Date' => 'Thu, 03 Aug 2017 16:04:35 GMT',
                    'Content-Type' => 'text/html',
                    'Content-Length' => '178',
                    'Array-Header' => array(
                        'value1', 'value2', 'value3',
                    ),
                    'Connection' => 'keep-alive',
                    'Location' => 'https://insales-dev.yamoney.ru/'
                ),
            ),
        );
    }
}