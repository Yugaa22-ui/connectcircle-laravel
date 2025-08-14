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

    public function badges()
    {
        return $this->belongsToMany(
            \App\Models\Badge::class, // Model badge
            'user_badges',           // Tabel pivot
            'user_id',               // Foreign key di pivot
            'badge_id'                // Foreign key di pivot
        );
    }

    public function interests()
    {
        return $this->belongsToMany(
            \App\Models\Interest::class, // Model interest
            'user_interests',            // Tabel pivot
            'user_id',                   // Foreign key di pivot
            'interest_id'                 // Foreign key di pivot
        );
    }
}
