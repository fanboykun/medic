<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'medicine_sale',
        'saler_name',
        'purchase_date',
        'sell_date',
        'total_sell',
    ];
}
