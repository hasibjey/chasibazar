<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Labor extends Model
{
    protected $fillable = ['service_id', 'type', 'shift', 'cost', 'description', 'status'];
}
