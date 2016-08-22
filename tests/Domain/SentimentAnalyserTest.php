<?php

namespace UnitTests\Domain;

use App\Domain\SentimentAnalyser;
use TestCase;

/**
 * Class NewsStoryTest
 *
 * @package UnitTests\Domain
 */
class SentimentAnalyserTest extends TestCase
{
    public function testScoresSentimentCorrectly()
    {
        $body = 'This is a story that contains some Positive work like ' .
            'success, gains and happy and some negative ones like drag and slump';

        $sentimentAnalyser = new SentimentAnalyser();
        $sentiment         = $sentimentAnalyser->getSentiment($body);

        $this->assertEquals(2, $sentiment);
    }
}
