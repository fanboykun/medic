<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'supplier_id',
        'purchase_date',
        'total_purchase',
    ];

    public function medicines () : \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Medicine::class)->withPivot(['quantity', 'purchase_price'])->withTimestamps();
    }


    public function supplier () : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

}
