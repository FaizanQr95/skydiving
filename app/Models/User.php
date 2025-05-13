<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable  implements CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;
    use \Illuminate\Auth\Passwords\CanResetPassword;

    protected $fillable = [
        'square_user_id', 'name','first_name','last_name', 'email', 'avatar', 'phone_number',
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

    public function getavatarUrlAttribute()
    {
        if ($this->avatar) {
            // Ensure you are using the 'public' disk
            return 'https://skydiverentalapp.com/storage/app/public/'.$this->avatar;
        }
        // Return a default image URL or null if no picture
        return asset('images/default-avatar.png'); // Example default
    }

    /**
     * Add this to the $appends array if you want the URL to be
     * automatically included when the model is serialized to JSON.
     */
    protected $appends = ['avatar_url'];

    public function sendPasswordResetNotification($token)
    {
        // Use your custom notification
        // We'll create this notification in the next step
        $this->notify(new \App\Notifications\ApiResetPasswordNotification($token));
    }
}

