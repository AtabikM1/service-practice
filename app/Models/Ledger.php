<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Material;

class Ledger extends Model
{
    use HasFactory;
    protected $fillable = [
        'material_id',
        'trans_type',
        'amount',
        'balance_after'
    ];
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
