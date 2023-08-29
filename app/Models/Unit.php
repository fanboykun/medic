<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',

    ];

    public function medicines () : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Medicine::class);
    }

}
