<?php

namespace App\Services;
use App\Models\Ledger;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class StockService{
    /**
     * @throws \Throwable
     */
    public function RecordTransaction(array $data){
        return DB::transaction(function () use ($data){
            $stock =Stock::firstOrCreate(
                ['material_id' => $data['material_id']],
                ['quantity' => 0]
            );
            $stock = Stock::where('id', $stock->id)->lockForUpdate()->first();
            $isIn = $data['trans_type'] === "in";
            $newWeight = $isIn ? $data['amount'] + $stock->quantity : $stock->quantity -$data['amount'];
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
                'quantity' => $newWeight
            ]);
        });
    }
    public function getHistory(Request $request): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = Ledger::with('material')->orderBy('created_at', 'desc');;
        if($request->filled('search')){
            $search = $request->search;;
            $query->whereHas('material', function($q) use ($search){
                $q->where('name', 'like', '%'.$search.'%');
            });
        }
        $sortBy  = $request->get('sort', 'created_at');
        $sortDir  = $request->get('direction', 'desc');
        $allowedSort = ['created_at', 'transaction_type', 'amount', 'balance_after'];
        if(in_array($sortBy, $allowedSort)){
            $query->orderBy($sortBy, $sortDir);
        }else{
            $query->latest();
        }
        return $query->paginate(15)->withQueryString();
    }
}
