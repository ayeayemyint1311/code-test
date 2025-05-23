<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'code',
        'category_id',
        'brand_id',
        'price',
        'quantity',
        'image',
        'description'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class);
    }
}
