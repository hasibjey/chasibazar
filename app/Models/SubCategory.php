<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCategory extends Model
{
    protected $fillable = ['image', 'name', 'slug', 'category_id', 'description', 'status'];

    public function Category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
