<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['service_id', 'title', 'type', 'description', 'timestamp'];
}
