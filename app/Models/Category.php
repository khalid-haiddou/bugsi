<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'image',
        'products_count'
    ];

    // Relationship with products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    // Update products count when products change
    public function updateProductsCount()
    {
        $this->products_count = $this->products()->count();
        $this->save();
    }
}