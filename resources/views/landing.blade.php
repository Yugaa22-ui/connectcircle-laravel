@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
  <div class="container py-5">
    <h1 class="display-4 fw-bold text-white">Temukan Teman Sejalan</h1>
    <p class="lead text-white">
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
      <a href="{{ url('/guest/dashboard') }}" class="btn btn-secondary btn-lg">
        <i class="bi bi-eye"></i> Masuk sebagai Guest
      </a>
    </div>
  </div>
</section>
@endsection
