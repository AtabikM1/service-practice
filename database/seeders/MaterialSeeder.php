<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'cement'],
            ['name' => 'fish'],
        ];
        foreach ($data as $d) {
            Material::firstOrCreate($d);
        }
    }
}
