<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
        public function index()
    {
        $user = Auth::user();
        $badges = $user->badges;
        $interests = $user->interests->pluck('name');

        if (request()->has('embed')) {
            return view('user.profile_content', compact('user', 'badges', 'interests'));
        }

        return view('user.profile', compact('user', 'badges', 'interests'));
    }
}
