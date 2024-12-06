<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = ['title', 'category_id', 'sub_category_id', 'description', 'quantity', 'price'];

    public function Category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function SubCategory():BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }
}
