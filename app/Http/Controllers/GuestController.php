<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Circle;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function index()
    {
        // Ambil circle terbaru
        $circles = Circle::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Ambil pengguna aktif (berdasarkan jumlah post terbanyak)
        $users = User::select('users.id', 'users.username', 'users.profession', 'users.city', DB::raw('COUNT(posts.id) as total_post'))
            ->leftJoin('posts', 'posts.user_id', '=', 'users.id')
            ->groupBy('users.id', 'users.username', 'users.profession', 'users.city')
            ->orderByDesc('total_post')
            ->limit(5)
            ->get();

        return view('guest', compact('circles', 'users'));
    }
}
