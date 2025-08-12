<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Interest;

class RegisterController extends Controller
{
    public function showRegistrationForm(Request $request)
    {
        // Bersihkan old input kalau ini GET fresh tanpa error validasi
        if (!$request->old()) {
            $request->session()->forget('_old_input');
        }

        $interests = Interest::all(); // ambil semua interest untuk form
        return view('auth.register', compact('interests'));
    }

    public function register(Request $request)
    {
        // Map confirm_password → password_confirmation agar rule confirmed Laravel jalan
        if ($request->has('confirm_password')) {
            $request->merge(['password_confirmation' => $request->input('confirm_password')]);
        }

        $rules = [
            'username' => ['required','string','max:100'],
            'email' => ['required','email','max:150','unique:users,email'],
            'password' => [
                'required',
                'string',
                'confirmed', // cocok dengan password_confirmation
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/'
            ],
            'city' => ['nullable','string','max:100'],
            'profession' => ['nullable','string','max:100'],
            'bio' => ['nullable','string'],
            'interests' => ['required','array','min:1','max:3'],
            'interests.*' => ['integer','exists:interests,id'],
        ];

        $messages = [
            'password.regex' => 'Password minimal 8 karakter, harus mengandung huruf besar, kecil, dan angka.',
            'interests.required' => 'Pilih minimal 1 minat.',
            'interests.max' => 'Maksimal pilih 3 minat.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        // Cek domain email MX kalau bukan di localhost
        $validator->after(function ($validator) use ($request) {
            if (!app()->environment('local')) {
                $email = $request->input('email');
                if ($email) {
                    $domain = substr(strrchr($email, "@"), 1);
                    if ($domain && !checkdnsrr($domain, "MX")) {
                        $validator->errors()->add('email', 'Domain email tidak aktif.');
                    }
                }
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan user + interests
        DB::beginTransaction();
        try {
            $user = User::create([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'city' => $request->input('city'),
                'profession' => $request->input('profession'),
                'bio' => $request->input('bio'),
                'role' => 'user', // default
            ]);

            // Simpan interests di pivot
            $user->interests()->attach($request->input('interests'));

            DB::commit();
            return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan login.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['global' => 'Gagal mendaftar. Silakan coba lagi.']);
        }
    }
}
