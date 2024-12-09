<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['title', 'category_id', 'sub_category_id', 'description', 'quantity', 'price', 'thumbnail', 'status'];

    public function Category():BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function SubCategory():BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
    public function Images():HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
