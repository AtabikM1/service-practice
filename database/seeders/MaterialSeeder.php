<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        $materials = [
            ['name' => 'Besi Baja 10mm'],
            ['name' => 'Kabel Tembaga 5m'],
            ['name' => 'Semen Portland 50kg'],
            ['name' => 'Baut Hexagonal M8'],
        ];

        foreach ($materials as $material) {
            Material::firstOrCreate(
                ['name' => $material['name']]
            );
        }

        $this->command->info('✅ Master Data Material berhasil di-seed.');
    }
}
