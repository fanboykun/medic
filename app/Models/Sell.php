<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'invoice',
        'saler_name',
        'purchase_date',
        'sell_date',
        'total_sell',
    ];
}
