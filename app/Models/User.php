<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false; // hilangkan updated_at error

    protected $fillable = [
        'username',
        'email',
        'password',
        'city',
        'profession',
        'bio',
        'role',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'user_interests', 'user_id', 'interest_id');
    }
}
