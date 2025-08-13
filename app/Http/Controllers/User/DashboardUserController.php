<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // otomatis dapat user_id, username, role, dll

        return view('user.dashboard_user', [
            'username' => $user->username
        ]);
    }
}
