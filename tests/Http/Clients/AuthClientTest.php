<?php

namespace UnitTests\Http\Clients;

use App\Http\Clients\Auth;
use Mockery;
use TestCase;

/**
 * Class AuthClientTest
 *
 * @package UnitTests\Http\Clients
 */
class AuthClientTest extends TestCase
{
    /**
     * @var AuthClient
     */
    protected $authClient;

    public function setUp()
    {
        parent::setUp();
    }

    public function testReturnsTrueResponseIf200()
    {
        $mockClient   = Mockery::mock('GuzzleHttp\Client');
        $mockClient->shouldReceive('get')->once()->andReturn(null);

        $authClient = new Auth($mockClient);
        $result     = $authClient->get('testtoken');

        $this->assertTrue($result);
    }

    public function testReturnsFalse()
    {
        $mockClient   = Mockery::mock('GuzzleHttp\Client');
        $mockClient->shouldReceive('get')->once()->andThrow(new \Exception());

        $authClient = new Auth($mockClient);
        $result     = $authClient->get('testtoken');

        $this->assertFalse($result);
    }
}
