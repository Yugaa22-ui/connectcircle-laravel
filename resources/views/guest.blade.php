@extends('layouts.app')

@section('content')
<main class="container py-5">
  <h1 class="text-center mb-4">Selamat Datang di ConnectCircle</h1>
  <p class="text-center text-muted mb-5">
    Kamu sedang mengakses sebagai <strong>Guest</strong>. Untuk bergabung ke circle dan berdiskusi, silakan login atau daftar dulu.
  </p>

  <!-- Circle Terbaru -->
  <h4><i class="bi bi-arrow-repeat"></i> Circle Terbaru</h4>
  <div class="list-group mb-5">
    @forelse($circles as $c)
      <div class="list-group-item bg-dark text-white border-secondary">
        <h5>{{ $c->name }}</h5>
        <p>{{ $c->description }}</p>
        <small class="text-muted">Dibuat pada: {{ $c->created_at->format('d M Y') }}</small>
      </div>
    @empty
      <p class="text-muted">Belum ada circle yang tersedia.</p>
    @endforelse
  </div>

  <!-- Pengguna Aktif -->
  <h4><i class="bi bi-fire"></i> Pengguna Aktif</h4>
  <ul class="list-group">
    @foreach($users as $u)
      <li class="list-group-item bg-dark text-white border-secondary">
        <strong>{{ $u->username }}</strong>
        ({{ $u->profession ?? '-' }} dari {{ $u->city ?? '-' }})<br>
        <small class="text-muted">Posting: {{ $u->total_post }} diskusi</small>
      </li>
    @endforeach
  </ul>

  <!-- CTA -->
  <div class="text-center mt-5">
    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
      <i class="bi bi-box-arrow-in-right"></i> Login untuk Bergabung
    </a>
  </div>
</main>
@endsection
