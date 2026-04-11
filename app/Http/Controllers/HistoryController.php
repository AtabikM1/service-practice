<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StockService;
class HistoryController extends Controller
{
    protected $stockService;
    public function __construct(StockService $stockService){
        $this->stockService = $stockService;
    }
    public function index(Request $request){
        $histories = $this->stockService->getHistory($request);
        return view('history.index', compact('histories'));
    }
}
