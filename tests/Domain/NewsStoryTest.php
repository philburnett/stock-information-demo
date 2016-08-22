<?php

namespace UnitTests\Domain;

use App\Domain\NewsStory;
use TestCase;

/**
 * Class NewsStoryTest
 *
 * @package UnitTests\Domain
 */
class NewsStoryTest extends TestCase
{
    public function testConstructor()
    {
        $story = new NewsStory('foo', 'bar', 0);
        $this->assertEquals('foo', $story->getHeadline());
        $this->assertEquals('bar', $story->getBody());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionWithInvalidHeadline()
    {
        new NewsStory('', 'bar', 0);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionWithInvalidBody()
    {
        new NewsStory('foo', '', 0);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionWithInvalidSentiment()
    {
        new NewsStory('foo', 'bar', 'A');
    }
}
