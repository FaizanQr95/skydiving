<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin'; // important

    protected $fillable = [
        'name', 'email', 'password','image',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
