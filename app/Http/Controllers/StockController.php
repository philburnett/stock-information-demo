<?php

namespace App\Http\Controllers;

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
     * @param StockService $stockService
     */
    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function getList()
    {
        dd('getList');
        exit;
    }

    public function getInfo()
    {
        dd('getInfo');
    }
}
