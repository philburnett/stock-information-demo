<?php

namespace UnitTests\Http\Controllers;

use TestCase;

/**
 * Class CompaniesControllerTest
 *
 * @package UnitTests\Http\Controllers
 */
class CompaniesControllerTest extends TestCase
{
    public function testReturns200()
    {
        $this->call('GET', 'companies');
        $this->assertResponseOk();
    }
}
