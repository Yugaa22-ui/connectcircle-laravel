<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $table = 'badges';
    protected $fillable = ['name', 'description', 'icon'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_badges', 'badge_id', 'user_id');
    }
}
