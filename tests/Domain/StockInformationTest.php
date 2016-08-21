<?php

namespace UnitTests\Domain;

use App\Domain\StockInformation;
use App\Domain\StockTicker;
use TestCase;

/**
 * Class NewsStoryTest
 *
 * @package UnitTests\Domain
 */
class StockInformationTest extends TestCase
{
    public function testFromApiConstructor()
    {
        $stockInformation = StockInformation::fromApi(new StockTicker('Google', 'GOOG'), $this->getMockApiData());
        $this->assertInstanceOf('App\Domain\StockInformation', $stockInformation);

        $this->assertEquals('Google', $stockInformation->getName());
        $this->assertEquals('GOOG', $stockInformation->getTickerCode());
        $this->assertEquals('pence', $stockInformation->getCurrencyText());
        $this->assertInstanceOf('Money\Money', $stockInformation->getLatestPrice());
        $this->assertInstanceOf('DateTime', $stockInformation->getAsOf());
        $this->asserttrue(is_array($stockInformation->getNews()));
    }

    protected function getMockApiData()
    {
        $json = file_get_contents(__DIR__ . '/../mock-data/GOOG.json');
        $apiData = json_decode($json, true);
        $apiData['news'] = [];
        return $apiData;
    }
}
