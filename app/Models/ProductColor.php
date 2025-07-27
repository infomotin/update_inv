<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $guarded = [];

    /**
     * Get the products associated with the color.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'color_id');
    }

    /**
     * Get the sizes associated with the product color.
     */
    public function sizes()
    {
        return $this->hasMany(ProductSize::class, 'color_id');
    }

    /**
     * Get the images associated with the product color.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'color_id');
    }
}

