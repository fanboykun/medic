<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine_purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'purchase_id',
        'quantity',
        'purchase_price',
    ];
}
