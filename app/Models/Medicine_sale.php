<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine_sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'sell_id',
        'selling_price',
        'quantity',
    ];
}
