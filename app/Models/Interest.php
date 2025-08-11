<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $table = 'interests';
    public $timestamps = false;
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_interests', 'interest_id', 'user_id');
    }
}
