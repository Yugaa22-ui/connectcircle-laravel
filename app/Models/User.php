<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Matikan timestamps karena di tabel tidak ada updated_at & created_at otomatis
    public $timestamps = false;

    // Sesuaikan fillable dengan kolom di tabel users
    protected $fillable = [
        'username',
        'email',
        'password',
        'city',
        'profession',
        'bio',
        'created_at',
        'role',
        'profile_picture'
    ];
}
