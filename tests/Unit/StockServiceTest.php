<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;
use App\Models\Material;
use App\Models\Stock;
use App\Models\Ledger;
use App\Services\StockService;
class StockServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    use refreshDatabase;
    protected StockService $stockService;
    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new StockService();
    }
    /** $test */
    public function ini_bisa_rekam_transaksi_dan_update(){
        $material = Material::create(['name' => 'Besi Beton']);
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
            'trans_type' => 'in',
            'amount' => 100,
            'balance_after' => 100
        ]);
    }
    /** @test */
    public function ini_lempar_exception_when_stock_is_insufficient(){
        $material = Material::create(['name' => 'Besi Beton']);
        Stock::create(['material_id' => $material->id, 'quantity' => 50]);
        $data = [
            'material_id' => $material->id,
            'trans_type' => "out",
            'amount' => 60,
        ];
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('stock tidak cukup untk transaksi');
        $this->service->RecordTransaction($data);
    }
}
