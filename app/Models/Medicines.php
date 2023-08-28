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
}
