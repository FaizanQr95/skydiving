<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = [
        'identifier',
        'otp',
        'expires_at',
        'temp_data',
    ];


    public $timestamps = true;
}

