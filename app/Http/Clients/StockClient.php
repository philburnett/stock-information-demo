<?php

namespace App\Http\Clients;

use App\Domain\StockTicker;
use App\Exceptions\StockInformationNotAvailableException;
use Exception;
use GuzzleHttp\Client;

/**
 * Class StockClientTest
 *
 * @package App\Http\Clients
 */
class StockClient
{
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * StockClientTest constructor.
     *
     * @param Client $httpClient
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->baseUrl    = 'http://mm-recruitment-stock-price-api.herokuapp.com/company/';
    }

    /**
     * @param StockTicker $stockTicker
     *
     * @return array
     * @throws StockInformationNotAvailableException
     */
    public function get(StockTicker $stockTicker)
    {
        $url      = $this->baseUrl . $stockTicker->getTickerCode();

        try {
            $response = $this->httpClient->get($url);
        } catch (Exception $e) {
            throw new StockInformationNotAvailableException();
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}
