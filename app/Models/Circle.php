<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    use HasFactory;

    protected $table = 'circles'; // nama tabel
    protected $fillable = [
        'name',
        'description',
        'is_private',
        'created_at',
        'updated_at',
    ];
}
