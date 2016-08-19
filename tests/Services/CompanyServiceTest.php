<?php

namespace UnitTests\Services;

use App\Services\CompanyService;
use Mockery;
use Mockery\MockInterface;
use TestCase;

/**
 * Class CompanyServiceTest
 *
 * @package UnitTests\Services
 */
class CompanyServiceTest extends TestCase
{
    /**
     * @var App\Services\CompanyService
     */
    protected $companyService;

    /**
     * @var MockInterface
     */
    protected $companyRepo;

    public function setUp()
    {
        $this->companyRepo    = Mockery::mock('App\Repositories\CompanyRepository');
        $this->companyService = new CompanyService($this->companyRepo);
    }

    public function testReturnsResultFromRepo()
    {
        $this->companyRepo->shouldReceive('getAll')->once()->andReturn('foo');

        $result = $this->companyService->getAll();
        $this->assertEquals('foo', $result);
    }
}
