<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class SquareUser extends Authenticatable
{
    use HasApiTokens;

    public $timestamps = false;
    public $exists = false;

    protected $fillable = [
        'id', 'name', 'email'
    ];

    protected $hidden = ['remember_token'];

    public function getAuthIdentifierName(): string
    {
        return 'id';
    }

    public function getAuthIdentifier(): mixed
    {
        return $this->id;
    }

}
