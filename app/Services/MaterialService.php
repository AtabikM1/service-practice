<?php

namespace App\Services;

use App\Models\Material;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
class MaterialService
{
    public function getStats(){
        return  Material::with('stock')->latest()->paginate(15);


    }
    public function createMaterial(array $data)
    {
        return DB::transaction(function () use ($data) {
            $material = Material::firstOrCreate([
                'name' => $data['name']]
            );
            $stock = Stock::firstOrCreate([
                'material_id' => $material->id],
                ['quantity' => 0]
            );
        });
    }
    public function updateMaterial(Material $material, array $data)
    {
        return $material->update([
            'name' => $data['name']
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
