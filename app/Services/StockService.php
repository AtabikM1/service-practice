<?php

namespace App\Services;
use App\Models\Ledger;
use App\Models\Material;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
class StockServices{
    public function RecordTransaction(array $data){
        return DB::transaction(function () use ($data){
            $stock =Stock::firstOrCreate(
                ['material_id' => $data['material_id']],
                ['qty' => 0]
            );
            $isIn = $data['trans_type'] === "in";
            $newWeight = $isIn ? $data['amount'] + $stock->qty : $data['amount'] - $stock->qty;
            if(!$isIn && $newWeight < 0){
                throw new \Exception("stock tidak cukup untk transaksi");
            }
            Ledger::create([
                'material_id' => $data['material_id'],
                'trans_type' => $data['trans_type'],
                'amount' => $data['amount'],
                'balance_after' => $newWeight
            ]);
            $stock->update([
                'qty' => $newWeight
            ]);
        });
    }
}
