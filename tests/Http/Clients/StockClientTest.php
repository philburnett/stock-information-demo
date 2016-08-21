<?php

namespace UnitTests\Http\Clients;

use App\Domain\StockTicker;
use App\Http\Clients\StockClient;
use Mockery;
use TestCase;

/**
 * Class StockClientTest
 *
 * @package UnitTests\Http\Clients
 */
class StockClientTest extends TestCase
{
    public function testGetInfoReturnsArray()
    {
        $mockClient = Mockery::mock('GuzzleHttp\Client');
        $mockResponse = Mockery::mock('Psr\Http\Message\ResponseInterface');
        $mockContents = Mockery::mock('Psr\Http\Message\StreamInterface');
        $mockResponse->shouldReceive('getBody')->once()->andReturn($mockContents);
        $mockClient->shouldReceive('get')->once()->andReturn($mockResponse);
        $mockContents->shouldReceive('getContents')->once()->andReturn('{"foo":"bar"}');

        $stockClient = new StockClient($mockClient);
        $result = $stockClient->get(new StockTicker('Test', 'test'));

        $this->assertArrayHasKey('foo', $result);
        $this->assertEquals('bar', $result['foo']);
    }

    /**
     * @expectedException App\Exceptions\StockInformationNotAvailableException
     */
    public function testThrowsExceptionWithInvalidStatusCode()
    {
        $mockClient = Mockery::mock('GuzzleHttp\Client');
        $mockResponse = Mockery::mock('Psr\Http\Message\ResponseInterface');

        $mockClient->shouldReceive('get')->once()->andThrow(new \Exception());

        $stockClient = new StockClient($mockClient);
        $stockClient->get(new StockTicker('Test', 'test'));
    }
}
