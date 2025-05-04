<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAwarded extends Model
{
    use HasFactory;
    protected $fillable = ['coupon_code', 'user_id', 'points', 'discount', 'coupon_value', 'square_discount_id', 'status', 'expiry_date',];

    // app/Models/UserAwarded.php

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
