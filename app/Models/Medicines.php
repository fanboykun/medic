<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicines extends Model
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

    public function unit () : \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Unit::class);
    }

    public function category () : \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Category::class);
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
        return $this->belongsToMany(Purchases::class)->withPivot(['quantity', 'purchase_price']);
    }


}
