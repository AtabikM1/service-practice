<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock;
use App\Models\Ledger;

class Material extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama'
    ];
    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
    public function ledger()
    {
        return $this->hasMany(Ledger::class);
    }
}
