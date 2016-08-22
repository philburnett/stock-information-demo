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

        $mockSentimentAnalyser = \Mockery::mock('App\Domain\SentimentAnalyser');
        $mockStockClient       = \Mockery::mock('App\Http\Clients\StockClient');
        $mockNewsClient        = \Mockery::mock('App\Http\Clients\StockNewsClient');

        $mockStockClient->shouldReceive('get')->once()->andReturn($mockStockData);
        $mockNewsClient->shouldReceive('getNews')->once()->andReturn($mockNewsData);
        $mockSentimentAnalyser->shouldReceive('getSentiment')->times(2)->andReturn(0);

        $stockService = new StockService($mockStockClient, $mockNewsClient, $mockSentimentAnalyser);
        $result       = $stockService->getStockInfo(new StockTicker('Google', 'GOOG'));

        $this->assertInstanceOf('App\Domain\StockInformation', $result);

        // @todo - check contents of result
    }
}
