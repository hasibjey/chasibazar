<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Address extends Model
{
    protected $fillable = ['user_id', 'name', 'phone', 'division', 'district', 'address', 'note'];

    public function Division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }
    public function District(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
