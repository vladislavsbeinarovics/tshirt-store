<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    public function getImageUrlAttribute()
    {
        return $this->image_path
            ? asset('images/products/' . $this->image_path)
            : null;
    }
}
