<?php

namespace App\Http\Clients;

use App\Exceptions\StockNewsNotAvailableException;
use Exception;
use GuzzleHttp\Client;

/**
 * Class StockNewsClient
 */
class StockNewsClient
{
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * StockNewsClient constructor.
     *
     * @param Client $httpClient
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param $storyFeedUri
     *
     * @return array
     * @throws StockNewsNotAvailableException
     */
    public function getNews($storyFeedUri)
    {
        try {
            $response = $this->httpClient->get($storyFeedUri);
        } catch (Exception $e) {
            throw new StockNewsNotAvailableException();
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}
