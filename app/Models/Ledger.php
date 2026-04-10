<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Material;

/**
 * @property int $id
 * @property int $material_id
 * @property string $trans_type
 * @property string $amount
 * @property string $balance_after
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Material $material
 * @method static \Illuminate\Database\Eloquent\Builder|Ledger newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ledger newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ledger query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ledger whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ledger whereBalanceAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ledger whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ledger whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ledger whereMaterialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ledger whereTransType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ledger whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
