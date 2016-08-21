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
    private $headline;
    private $body;

    /**
     * NewsStory constructor.
     *
     * @param $headline
     * @param $body
     */
    public function __construct($headline, $body)
    {
        if (empty($headline) || empty($body)) {
            throw new InvalidArgumentException('Headline must have a headline and boby');
        }
        $this->headline = $headline;
        $this->body     = $body;
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
     * Static factory (named constructor)
     *
     * @param array $apiData
     *
     * @return NewsStory
     */
    public static function fromApiData(array $apiData)
    {
        return new NewsStory(
            $apiData['headline'],
            $apiData['body']
        );
    }
}
