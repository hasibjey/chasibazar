<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    public function Address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
