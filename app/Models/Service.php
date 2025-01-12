<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = ['title', 'image', 'description', 'hero_image'];

    public function Labor(): HasMany
    {
        return $this->hasMany(Labor::class, 'service_id');
    }
    public function Specialist(): HasMany
    {
        return $this->hasMany(Specialist::class, 'service_id');
    }
    public function Event(): HasMany
    {
        return $this->hasMany(Event::class, 'service_id');
    }
}
