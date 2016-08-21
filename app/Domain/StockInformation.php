<?php

namespace App\Domain;

use DateTime;
use Money\Currency;
use Money\Money;

/**
 * Class StockInformation
 *
 * Immutable class representing a stocks information at a particular time
 *
 * @package App\Domain
 */
class StockInformation
{
    /**
     * @var StockTicker
     */
    private $stockTicker;
    /**
     * @var Money
     */
    private $latestPrice;
    /**
     * @var DateTime
     */
    private $asOf;
    /**
     * @var array
     */
    private $news;
    /**
     * @var string
     */
    private $currencyText;

    /**
     * StockInformation constructor.
     *
     * @param StockTicker $stockTicker
     * @param Money       $latestPrice
     * @param             $currencyText
     * @param DateTime    $asOf
     * @param array       $news
     */
    public function __construct(
        StockTicker $stockTicker,
        Money $latestPrice,
        $currencyText,
        DateTime $asOf,
        array $news = []
    ) {
        $this->stockTicker = $stockTicker;
        $this->latestPrice = $latestPrice;
        $this->asOf        = $asOf;
        $this->news        = $news;
        $this->currencyText = $currencyText;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->stockTicker->getCompanyName();
    }

    public function getTickerCode()
    {
        return $this->stockTicker->getTickerCode();
    }

    /**
     * @return Money
     */
    public function getLatestPrice()
    {
        return $this->latestPrice;
    }

    /**
     * @return string
     */
    public function getCurrencyText()
    {
        return $this->currencyText;
    }

    /**
     * @return DateTime
     */
    public function getAsOf()
    {
        return $this->asOf;
    }

    /**
     * @return array
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Static factory method (named constructor)
     *
     * @param StockTicker $stockTicker
     * @param array       $apiData
     *
     * @return StockInformation
     */
    public static function fromApi(StockTicker $stockTicker, array $apiData)
    {
        $currencyCode = substr($apiData['priceUnits'], 0, 3);
        $currencyText = substr($apiData['priceUnits'], 4, strlen($apiData['priceUnits']));
        return new StockInformation(
            $stockTicker,
            new Money($apiData['latestPrice'], new Currency($currencyCode)),
            $currencyText,
            new DateTime($apiData['asOf']),
            $apiData['news']
        );
    }
}
