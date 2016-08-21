<?php

namespace UnitTests\Http\Clients;

use App\Http\Clients\StockNewsClient;
use Mockery;
use TestCase;

/**
 * Class StockClientTest
 *
 * @package UnitTests\Http\Clients
 */
class StockNewsClientTest extends TestCase
{
    public function testGetNewsReturnsContent()
    {
        $mockClient = Mockery::mock('GuzzleHttp\Client');
        $mockResponse = Mockery::mock('Psr\Http\Message\ResponseInterface');
        $mockContents = Mockery::mock('Psr\Http\Message\StreamInterface');
        $mockResponse->shouldReceive('getBody')->once()->andReturn($mockContents);
        $mockClient->shouldReceive('get')->once()->andReturn($mockResponse);
        $mockContents->shouldReceive('getContents')->once()->andReturn('{"foo":"bar"}');

        $stockClient = new StockNewsClient($mockClient);
        $result = $stockClient->getNews('http://www.example.com');

        $this->assertArrayHasKey('foo', $result);
        $this->assertEquals('bar', $result['foo']);
    }

    /**
     * @expectedException App\Exceptions\StockNewsNotAvailableException
     */
    public function testThrowsExceptionWithInvalidStatusCode()
    {
        $mockClient = Mockery::mock('GuzzleHttp\Client');
        $mockClient->shouldReceive('get')->once()->andThrow(new \Exception());

        $stockClient = new StockNewsClient($mockClient);
        $stockClient->getNews('http://www.example.com');
    }
}
