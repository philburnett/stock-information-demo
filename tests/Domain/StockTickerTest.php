<?php

namespace UnitTests\Domain;

use App\Domain\StockTicker;
use TestCase;

/**
 * Class NewsStoryTest
 *
 * @package UnitTests\Domain
 */
class StockTickerTest extends TestCase
{
    public function testConstructor()
    {
        $ticker = new StockTicker('Microsoft', 'MSFT');

        $this->assertEquals('Microsoft', $ticker->getCompanyName());
        $this->assertEquals('MSFT', $ticker->getTickerCode());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionWithInvalidCompanyName()
    {
        new StockTicker('', 'MSFT');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionWithInvalidTickerName()
    {
        new StockTicker('Microsoft', '');
    }
}
