<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Services\StockService;
use Illuminate\Database\Seeder;

class LedgerSeeder extends Seeder
{
    public function run(): void
    {
        $stockService = new StockService();

        // Ambil ID dari database agar dinamis dan tidak hardcode
        $besi = Material::where('name', 'Besi Baja 10mm')->first();
        $kabel = Material::where('name', 'Kabel Tembaga 5m')->first();
        $semen = Material::where('name', 'Semen Portland 50kg')->first();

        // Pastikan material ada sebelum membuat transaksi
        if (!$besi || !$kabel || !$semen) {
            $this->command->warn('⚠️ Material belum ada! Jalankan MaterialSeeder terlebih dahulu.');
            return;
        }

        $transactions = [
            // Transaksi Besi
            ['material_id' => $besi->id, 'trans_type' => 'in', 'amount' => 1000],
            ['material_id' => $besi->id, 'trans_type' => 'out', 'amount' => 250],

            // Transaksi Kabel
            ['material_id' => $kabel->id, 'trans_type' => 'in', 'amount' => 500],

            // Transaksi Semen (Stok masuk, lalu keluar melebihi stok untuk menguji error)
            ['material_id' => $semen->id, 'trans_type' => 'in', 'amount' => 100],
            // Jika validasimu jalan, transaksi di bawah ini akan memicu Exception
            ['material_id' => $semen->id, 'trans_type' => 'out', 'amount' => 150],
        ];

        $successCount = 0;
        $failCount = 0;

        foreach ($transactions as $data) {
            try {
                $stockService->recordTransaction($data);
                $successCount++;
            } catch (\Exception $exception) {
                // Menampilkan error spesifik per material tanpa menghentikan seeder sepenuhnya
                $this->command->error("❌ Gagal (Material ID {$data['material_id']}): " . $exception->getMessage());
                $failCount++;
            }
        }

        $this->command->info("📊 Selesai: {$successCount} transaksi berhasil, {$failCount} transaksi gagal (Ditolak by System).");
    }
}
