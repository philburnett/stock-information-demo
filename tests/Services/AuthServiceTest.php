<?php

namespace UnitTests\Services;

use App\Exceptions\InvalidTokenException;
use App\Services\AuthService;
use TestCase;

/**
 * Class AuthServiceTest
 *
 * @package UnitTests\Services
 */
class AuthServiceTest extends TestCase
{
    public function testReturnsTrue()
    {
        $mockClient = \Mockery::mock('App\Http\Clients\Auth');
        $mockClient->shouldReceive('get')->andReturn(true);
        $mockClient->shouldReceive('getResponse')->andReturn([]);

        $authService = new AuthService($mockClient);
        $result = $authService->getUser('foobar');

        $this->assertInstanceOf('App\Domain\User', $result);

    }

    /**
     * @expectedException App\Exceptions\InvalidTokenException
     */
    public function testThrowsException()
    {
        $mockClient = \Mockery::mock('App\Http\Clients\Auth');
        $mockClient->shouldReceive('get')->andReturn(false);

        $authService = new AuthService($mockClient);
        $result = $authService->getUser('foobar');
    }
}
