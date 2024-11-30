<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'status', 'nav_status', 'nav_position', 'index_status', 'index_position'];

    public function SubCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class);
    }
}
