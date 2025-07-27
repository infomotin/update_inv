<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $guarded = [];

    /**
     * Get the product that owns the size.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the color associated with the product size.
     */
    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'color_id');
    }
}
