<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'square_user_id', 'name', 'email', 'phone_number',
        'password', 'ref_id', 'invited_ref_ids'
    ];

    protected $casts = [
        'invited_ref_ids' => 'array',
    ];

    protected $hidden = ['password'];
    public function referrals()
    {
        return $this->hasMany(UserReferral::class, 'referral_id');
    }
}

