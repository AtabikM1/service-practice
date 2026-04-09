<?php

namespace App\Services;

use App\Models\Material;
use App\Models\Stock;
use App\Models\Ledger;

class DashboardService{
    public function getStats(){
        return [
            'total_material' => Material::count(),
            'total_qty' => Stock::sum('quantity'),
            'low_stock_items' => Stock::with('material')
            ->where('quantity', '<', 10)->get(),
            'recent_activities' => Ledger::with('material')
            ->latest()
            ->take(5)
            ->get()
        ];
    }
}