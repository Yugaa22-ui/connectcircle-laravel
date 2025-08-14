<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $badges = $user->badges;
        $interests = $user->interests->pluck('name');

        return view('user.profile', compact('user', 'badges', 'interests'));
    }
}
