<?php

namespace Tests\Feature;

use App\Services\StockService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Material;
use App\Models\Stock;
use App\Models\Ledger;
class stockServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
   use RefreshDatabase;
   protected StockService $stockService;
   protected function setUp(): void{
       parent::setUp();
       $this->stockService = new StockService();
   }
   public function ini_menambah_stock_dan_mencetak_ledger(){
       $material = Material::create(['name' => 'Baja Beton']);
       $data = [
           'material_id' => $material->id,
           'trans_type' => "in",
           'amount' => 100,
       ];
       $this->service->RecordTransaction($data);

       $this->assertDatabaseHas('stocks', [
           'material_id' => $material->id,
           'quantity' => 100,
       ]);
       $this->assertDatabaseHas('ledgers', [
           'material_id' => $material->id,
           'quantity' => 100,
       ]);
   }

}
