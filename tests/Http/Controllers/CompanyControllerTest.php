<?php

namespace UnitTests\Http\Controllers;

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
        $this->call('GET', 'companies');
        $this->assertResponseOk();
    }
}
