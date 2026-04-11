<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StockService;
class StockController extends Controller
{
    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }
    public function store(Request $request){
        $validated = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'trans_type' => 'required|in:in,out',
            'amount' => 'required|numeric|min:1',
        ]);
        try{
            $this->stockService->recordTransaction($validated);
            return redirect('/materials')->with('success', 'Transaction Successful');
        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }
    }
}
