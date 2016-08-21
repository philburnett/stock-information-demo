<?php

namespace App\Domain;

use InvalidArgumentException;

/**
 * Class StockTicker
 *
 * @package App\Domain\StockTicker
 */
class StockTicker
{
    /**
     * @var string
     */
    private $tickerCode;

    /**
     * @var string
     */
    private $companyName;

    /**
     * StockTicker constructor.
     *
     * @param $companyName
     * @param $tickerCode
     */
    public function __construct($companyName, $tickerCode)
    {
        if (empty($tickerCode)) {
            throw new InvalidArgumentException('Stock ticker cannot be empty');
        }

        if (empty($companyName)) {
            throw new InvalidArgumentException('Company name cannot be empty');
        }
        $this->companyName = $companyName;
        $this->tickerCode  = $tickerCode;
    }

    /**
     * @return string
     */
    public function getTickerCode()
    {
        return $this->tickerCode;
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }
}
