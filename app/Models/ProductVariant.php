<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $guarded = [];
    protected $casts = [
        'image' => 'array',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function size()
    {
        return $this->belongsTo(Size::class);
    }
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
