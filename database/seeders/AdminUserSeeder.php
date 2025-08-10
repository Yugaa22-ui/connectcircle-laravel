<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            User::create([
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'), // Ganti kalau mau
                'role' => 'admin',
                'created_at' => now()
            ]);
        }
    }
}
