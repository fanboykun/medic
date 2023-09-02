<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'storage',
        'stock',
        'unit_id',
        'category_id',
        'expired',
        'description',
        'purchase_price',
        'selling_price',
        'supplier_id',
    ];

    public function unit () : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->BelongsTo(Unit::class);
    }

    public function category () : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->BelongsTo(Category::class);
    }

    public function supplier () : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function sales () : \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Sell::class)->withPivot(['selling_price', 'quantity']);
    }

    public function purchases () : \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Purchase::class)->withPivot(['quantity', 'purchase_price']);
    }


}
