<?php

namespace App\Services;

use App\Domain\StockTicker;
use App\Repositories\CompanyRepository;

/**
 * Class CompanyService
 *
 * @package App\Services
 */
class CompanyService
{
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->companyRepository->getAll();
    }

    /**
     * @param $tickerCode
     *
     * @return StockTicker
     */
    public function getCompanyStockTicker($tickerCode)
    {
        $companyInfo = $this->companyRepository->getCompanyInformation($tickerCode);
        return new StockTicker($companyInfo['name'], $companyInfo['tickerCode']);
    }
}
