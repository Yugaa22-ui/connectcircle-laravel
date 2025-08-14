@extends('layouts.app')

@section('content')
<main class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card bg-dark border-secondary shadow">
        <div class="card-header border-bottom border-secondary d-flex justify-content-between align-items-center">
          <h4 class="mb-0 text-white"><i class="bi bi-person-circle me-2"></i> Profil Saya</h4>
        </div>

        <div class="card-body">
          <div class="text-center mb-4">
            <img
                src="{{ $user->profile_picture 
                    ? asset('storage/uploads/'.$user->profile_picture) 
                    : asset('img/default.png') }}"
                class="rounded-circle shadow"
                width="120"
                height="120"
                alt="Foto Profil">
          </div>

          <ul class="list-group list-group-flush">
            <li class="list-group-item bg-dark text-white"><strong>Username:</strong> {{ $user->username }}</li>
            <li class="list-group-item bg-dark text-white"><strong>Kota:</strong> {{ $user->city }}</li>
            <li class="list-group-item bg-dark text-white"><strong>Profesi:</strong> {{ $user->profession }}</li>
            <li class="list-group-item bg-dark text-white"><strong>Bio:</strong><br>{!! nl2br(e($user->bio)) !!}</li>
            <li class="list-group-item bg-dark text-white">
              <strong>Minat:</strong><br>
              @if($interests->isNotEmpty())
                @foreach ($interests as $interest)
                  <span class="badge interest-badge me-1 mb-1">{{ $interest }}</span>
                @endforeach
              @else
                <span class="text-muted">Belum memilih minat</span>
              @endif
            </li>
          </ul>

          <h5 class="mt-4 text-white"><i class="bi bi-patch-check-fill me-1"></i> Badge yang Dimiliki</h5>
          @if($badges->isNotEmpty())
            <div class="list-group">
              @foreach ($badges as $badge)
                <div class="list-group-item bg-dark text-white border-secondary">
                  <i class="bi bi-award"></i>
                  <strong>{{ $badge->name }}</strong><br>
                  <small>{{ $badge->description }}</small>
                </div>
              @endforeach
            </div>
          @else
            <p class="text-muted">Belum ada badge.</p>
          @endif
        </div>

        <div class="card-footer border-top border-secondary d-flex justify-content-end gap-2">
          {{-- <a href="{{ route('profile.edit') }}" class="btn btn-outline-info"><i class="bi bi-pencil-square"></i> Edit Profil</a> --}}
          {{-- <a href="{{ route('password.change') }}" class="btn btn-outline-warning"><i class="bi bi-key"></i> Ubah Password</a> --}}
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
