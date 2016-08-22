<?php

namespace App\Domain;

/**
 * Class SentimentAnalyser
 *
 * @package App\Domain
 */
class SentimentAnalyser
{
    // @todo - inject words from env
    private $positive = [
        'positive',
        'success',
        'grow',
        'gains',
        'happy',
        'healthy'
    ];

    private $negative = [
        'disappointing',
        'concerns',
        'decline',
        'drag',
        'slump',
        'feared'
    ];

    /**
     * @param $text
     *
     * @return int
     */
    public function getSentiment($text)
    {
        $bodyNoPunctuation = preg_replace('/\p{P}/u', ' ', $text);

        $words = explode(' ', $bodyNoPunctuation);

        $sentiment = 0;
        foreach ($words as $word) {
            $word = strtolower(trim($word));
            if (in_array($word, $this->positive)) {
                $sentiment++;
            }

            if (in_array($word, $this->negative)) {
                $sentiment--;
            }
        }

        return $sentiment;
    }
}
