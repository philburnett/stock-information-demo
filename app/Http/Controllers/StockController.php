<?php

namespace App\Http\Controllers;

use App\Exceptions\CompanyNotFoundException;
use App\Services\CompanyService;
use App\Services\StockService;

/**
 * Class StockController
 *
 * @package App\Http\Controllers
 */
class StockController extends Controller
{
    /**
     * @var StockService
     */
    private $stockService;
    /**
     * @var CompanyService
     */
    private $companyService;

    /**
     * @param StockService   $stockService
     * @param CompanyService $companyService
     */
    public function __construct(StockService $stockService, CompanyService $companyService)
    {
        $this->stockService   = $stockService;
        $this->companyService = $companyService;
    }

    /**
     * @param $tickerCode
     *
     * @return \Illuminate\View\View
     */
    public function getInfo($tickerCode)
    {
        try {
            $stockTicker = $this->companyService->getCompanyStockTicker($tickerCode);
            $stock       = $this->stockService->getStockInfo($stockTicker);
        } catch (CompanyNotFoundException $e) {
            // @todo - Log this
            abort(404);
        } catch (StockInformationNotAvailableException $e) {
            // @todo - Log this
            abort(404);
        } catch (Exception $e) {
            abort(404);
        }

        return view('stock-information', ['stock' => $stock]);
    }
}
