<?php

namespace UnitTests\Http\Controllers;

use App\Exceptions\InvalidTokenException;
use Mockery;
use TestCase;

/**
 * Class CompanyControllerTest
 *
 * @package UnitTests\Http\Controllers
 */
class CompanyControllerTest extends TestCase
{
    /**
     * Full end to end integration test
     */
    public function testReturns200()
    {
        $mockAuthService = Mockery::mock('App\Services\AuthService');
        $mockAuthService->shouldReceive('isAuthorised')->andReturn(true);

        $this->app->instance('App\Services\AuthService', $mockAuthService);

        $this->call('GET', 'companies', [], ['MERGERMARKET' => 'foobar']);
        $this->assertResponseOk();
    }

    public function testReturns500()
    {
        $mockAuthService = Mockery::mock('App\Services\AuthServiceInterface');
        $mockAuthService->shouldReceive('getUser')->andThrow(new InvalidTokenException());

        $this->app->instance('App\Services\AuthServiceInterface', $mockAuthService);

        $this->call('GET', 'companies', ['noauth' => 1], ['MERGERMARKET' => 'foobar']);
        $this->assertResponseStatus(401);
    }
}
