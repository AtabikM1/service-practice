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
    public function index(){
        $materials = $this->materialService->getStats();
        return view('materials.index', compact('materials'));
    }
    public function create(){
        return view('materials.create');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|unique:materials,name'
        ]);
        $material = $this->materialService->createMaterial($validated);
        return redirect()->route('materials.index')->with('success', 'Material has been created.');
    }

}
