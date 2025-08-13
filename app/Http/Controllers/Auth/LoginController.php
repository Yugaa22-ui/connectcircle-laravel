<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login_email' => 'required|email',
            'login_password' => 'required'
        ], [
            'login_email.required' => 'Email harus diisi.',
            'login_email.email' => 'Format email tidak valid.',
            'login_password.required' => 'Password harus diisi.'
        ]);

        $user = User::where('email', $request->login_email)->first();

        if (!$user) {
            return back()
                ->withErrors(['login_email' => 'Email tidak ditemukan.'])
                ->withInput(['login_email' => $request->login_email]);
        }

        if (!Hash::check($request->login_password, $user->password)) {
            return back()
                ->withErrors(['login_password' => 'Password salah.'])
                ->withInput(['login_email' => $request->login_email]);
        }

        Auth::login($user);

        // Redirect berdasarkan role
        if (in_array($user->role, ['admin', 'moderator'])) {
            return redirect()->route('admin.dashboard');
        }
        
        return redirect()->route('user.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
