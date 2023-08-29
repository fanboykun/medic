<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',];

    public function medicines () : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Medicines::class);
    }


}
