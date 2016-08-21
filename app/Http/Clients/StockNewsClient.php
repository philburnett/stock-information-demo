<?php

namespace App\Http\Clients;

use App\Exceptions\StockNewsNotAvailableException;
use Exception;
use GuzzleHttp\Client;
use Psr\Http\Message\StreamInterface;

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
     * @return StreamInterface
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
