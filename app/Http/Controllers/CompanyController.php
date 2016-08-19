<?php

namespace App\Http\Controllers;

use App\Services\CompanyService;

/**
 * Class CompanyController
 *
 * @package App\Http\Controllers
 */
class CompanyController extends Controller
{
    /**
     * @var CompanyService
     */
    private $companyService;

    /**
     * @param CompanyService $companyService
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function getList()
    {
        $companies = $this->companyService->getAll();

        return view(
            'companies',
            ['companies' => $companies]
        );
    }
}
