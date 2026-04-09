<?php

namespace App\Services;

use App\Models\Material;
use App\Models\Ledger;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class MaterialService
{
    public function createMaterial(array $data)
    {
        return Material::create([
            'name' => $data['name'],
        ]);
    }
    public function updateMaterial(Material $material, array $data)
    {
        $material->update([
            'nama' => $data['nama']
        ]);
    }
    public function deleteMaterial(Material $material)
    {
        if ($material->stock()->exist() || $material->ledgers()->exist()) {
            throw new \Exception("material tidak bisa dihapus");
        }
        return $material->delete();
    }
}
