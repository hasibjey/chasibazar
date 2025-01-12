<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    protected $fillable = ['hero_image', 'slog', 'labor_id', 'specialist_id', 'event_id'];

    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function SubCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'Sub_category_id');
    }
    public function Labor(): BelongsTo
    {
        return $this->belongsTo(Labor::class, 'id');
    }
}
