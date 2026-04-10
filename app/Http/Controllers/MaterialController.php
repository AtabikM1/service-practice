<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MaterialService;
use App\Models\Material;
use App\Models\Stock;
class MaterialController extends Controller
{
    protected $materialService;
    public function __construct(MaterialService $materialService)
    {
        $this->materialService = $materialService;
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|unique'
        ]);
        $material = $this->materialService->createMaterial($validated);
    }
    public function update(Request $request){
        $validated = $request->validate([
            'name' => 'required|string'
        ]);
        $material = $this->materialService->updateMaterial($validated);
    }
    public function delete(Material $material){
        $material->delete();
    }
}
