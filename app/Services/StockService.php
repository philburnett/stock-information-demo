<?php

namespace App\Services;

use App\Domain\NewsStory;
use App\Domain\SentimentAnalyser;
use App\Domain\StockInformation;
use App\Domain\StockTicker;
use App\Http\Clients\StockClient;
use App\Http\Clients\StockNewsClient;
use Exception;

/**
 * Class StockService
 *
 * @package App\Services
 */
class StockService
{
    /**
     * @var StockClient
     */
    private $stockClient;
    /**
     * @var StockNewsClient
     */
    private $stockStoryClient;
    /**
     * @var SentimentAnalyser
     */
    private $sentimentAnalyser;

    /**
     * StockService constructor.
     *
     * @param StockClient       $stockClient
     * @param StockNewsClient   $stockStoryClient
     * @param SentimentAnalyser $sentimentAnalyser
     */
    public function __construct(
        StockClient $stockClient,
        StockNewsClient $stockStoryClient,
        SentimentAnalyser $sentimentAnalyser
    ) {
        $this->stockClient       = $stockClient;
        $this->stockStoryClient  = $stockStoryClient;
        $this->sentimentAnalyser = $sentimentAnalyser;
    }

    /**
     * @param StockTicker $stockTicker
     *
     * @return StockInformation
     */
    public function getStockInfo(StockTicker $stockTicker)
    {
        $content         = $this->stockClient->get($stockTicker);
        $content['news'] = [];

        if (!empty($content['storyFeedUrl'])
            && filter_var($content['storyFeedUrl'], FILTER_VALIDATE_URL)
        ) {
            try {
                $news            = $this->stockStoryClient->getNews($content['storyFeedUrl']);
                $content['news'] = array_map(
                    function ($newsStory) {
                        return NewsStory::fromApiData(
                            $newsStory,
                            $this->sentimentAnalyser->getSentiment($newsStory['body'])
                        );
                    }, $news
                );
            } catch (Exception $e) {
                // todo: Log error
            }
        }

        return StockInformation::fromApi($stockTicker, $content);
    }
}
