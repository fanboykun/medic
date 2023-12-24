<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Medicine extends Model
{
    use HasFactory;
    // use SoftDeletes;

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

    protected $appends = ['is_expired', 'price_diff'];

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
        return $this->belongsToMany(Sell::class)->withPivot(['selling_price', 'quantity'])->withTimestamps();
    }

    public function purchases () : \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Purchase::class)->withPivot(['quantity', 'purchase_price',])->withTimestamps();
    }

    public function getIsExpiredAttribute()
    {
        $formatted_date = \Carbon\Carbon::createFromFormat('Y-m-d', $this->expired);
        return $formatted_date <= today();
    }

    public function getPriceDiffAttribute()
    {
        return (float) ($this->selling_price - $this->purchase_price);
    }


}
