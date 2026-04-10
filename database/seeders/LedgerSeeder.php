<?php

namespace Database\Seeders;

use App\Models\Ledger;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Stock;
use App\Services\StockService;
use Illuminate\Database\Seeder;
use App\Models\Material;
class LedgerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $stockService = new StockService();
       if(Material::count() === 0) {
           Material::insert([
               ['name' => 'cement'],
               ['name' => 'bag'],
           ]);
       }
       $transactions =[[
           'material_id' => 1,
           'trans_type' => 'in',
           'amount' => 100,]
       ];
       foreach ($transactions as $data) {
            try{
                $stockService->recordTransaction($data);
            }catch (\Exception $exception){
                $this->command->error($exception->getMessage());
            }
       }

    }
}
