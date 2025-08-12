@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<main class="flex-grow-1 d-flex flex-column justify-content-center align-items-center text-center py-5">
    <div class="container">
        <h1 class="fw-bold display-4 text-white px-3 d-inline-block rounded">
            Temukan Teman Sejalan
        </h1>
        <p class="lead mt-3 text-white-50">
            ConnectCircle membantumu menemukan kolaborator berdasarkan minat yang sama.<br>
            Buat circle, berdiskusi, dan bangun komunitas yang produktif.
        </p>

        <div class="mt-4 d-flex flex-wrap gap-2 justify-content-center">
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                <i class="bi bi-person-plus"></i> Daftar
            </a>
            <a href="{{ url('/guest') }}" class="btn btn-secondary btn-lg">
                <i class="bi bi-eye"></i> Masuk sebagai Guest
            </a>
        </div>
    </div>
</main>
@endsection
