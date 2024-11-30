<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['email', 'phone', 'alterPhone', 'whatsapp', 'calling_hours'];
}
