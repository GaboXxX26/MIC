<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo(category::class);
    }
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
    ];
}
