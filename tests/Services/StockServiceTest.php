<?php

namespace UnitTests\Services;

use App\Domain\StockTicker;
use App\Services\StockService;
use TestCase;

/**
 * Class StockServiceTest
 *
 * @package UnitTests\Services
 */
class StockServiceTest extends TestCase
{
    public function testGetStockInfo()
    {
        $mockStockData = json_decode(file_get_contents(__DIR__ . '/../mock-data/GOOG.json'), true);
        $mockNewsData  = json_decode(file_get_contents(__DIR__ . '/../mock-data/news.json'), true);

        $mockStockClient = \Mockery::mock('App\Http\Clients\StockClient');
        $mockNewsClient = \Mockery::mock('App\Http\Clients\StockNewsClient');

        $mockStockClient->shouldReceive('get')->once()->andReturn($mockStockData);
        $mockNewsClient->shouldReceive('getNews')->once()->andReturn($mockNewsData);

        $stockService = new StockService($mockStockClient, $mockNewsClient);
        $result = $stockService->getStockInfo(new StockTicker('Google', 'GOOG'));

        $this->assertInstanceOf('App\Domain\StockInformation', $result);

        // @todo - check contents of result
    }
}
