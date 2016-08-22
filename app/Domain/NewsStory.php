<?php

namespace App\Domain;

use InvalidArgumentException;

/**
 * Class NewsStory
 *
 * @package App\Domain
 */
class NewsStory
{
    /**
     * @var string
     */
    private $headline;
    /**
     * @var string
     */
    private $body;
    /**
     * @var int
     */
    private $sentiment;

    /**
     * NewsStory constructor.
     *
     * @param $headline
     * @param $body
     * @param $sentiment
     */
    public function __construct($headline, $body, $sentiment)
    {
        if (empty($headline) || empty($body)) {
            throw new InvalidArgumentException('Headline must have a headline and boby');
        }

        if (!is_int($sentiment)) {
            throw new InvalidArgumentException('Sentiment must be an integer');
        }
        $this->headline  = $headline;
        $this->body      = $body;
        $this->sentiment = $sentiment;
    }

    /**
     * @return mixed
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getSentiment()
    {
        return $this->sentiment;
    }

    /**
     * Static factory (named constructor)
     *
     * @param array $apiData
     *
     * @return NewsStory
     */
    public static function fromApiData(array $apiData, $sentiment = 0)
    {
        return new NewsStory(
            $apiData['headline'],
            $apiData['body'],
            $sentiment
        );
    }
}
