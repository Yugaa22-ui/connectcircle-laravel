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
    public function showRegistrationForm()
    {
        $interests = Interest::all(); // untuk checkbox di form
        return view('auth.register', compact('interests'));
    }

    public function register(Request $request)
    {
        if ($request->has('confirm_password')) {
            $request->merge(['password_confirmation' => $request->input('confirm_password')]);
        }

        $rules = [
            'username' => ['required','string','max:100'],
            'email' => ['required','email','max:150','unique:users,email'],
            // gunakan rule confirmed -> butuh password_confirmation
            'password' => ['required','string','confirmed','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/'],
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

        // Opsional: cek domain email MX (non-local)
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

        // Simpan user + interests di transaction
        DB::beginTransaction();
        try {
            $user = User::create([
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'city' => $request->input('city'),
                'profession' => $request->input('profession'),
                'bio' => $request->input('bio'),
                // default role 'user' (atau tetapkan sesuai kebutuhan)
                'role' => $request->input('role', 'user'),
            ]);

            // attach interests (user_interests)
            $interests = $request->input('interests', []);
            if (!empty($interests)) {
                // pakai relation (pastikan relation dibuat di model)
                $user->interests()->attach($interests);
            }

            DB::commit();

            return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan login.');
        } catch (\Throwable $e) {
            DB::rollBack();
            // log jika perlu: \Log::error($e);
            return redirect()->back()->withInput()->withErrors(['global' => 'Gagal mendaftar. Silakan coba lagi.']);
        }
    }
}
