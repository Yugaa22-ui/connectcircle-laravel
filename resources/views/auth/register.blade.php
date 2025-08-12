@extends('layouts.app')

@section('content')
<main class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow border-0">
        <div class="card-header card-header-dark">
          <h3 class="mb-0">Daftar Akun Baru</h3>
        </div>
        <div class="card-body">

          {{-- Pesan error global --}}
          @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
          @endif

          <form method="POST" action="{{ route('register.post') }}">
            @csrf

            {{-- Username --}}
            <div class="mb-3">
              <label class="form-label">Username *</label>
              <input type="text" name="username"
                     class="form-control @error('username') is-invalid @enderror"
                     value="{{ old('username') }}">
              @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
              <label class="form-label">Email *</label>
              <input type="text" name="email"
                     class="form-control @error('email') is-invalid @enderror"
                     value="{{ old('email') }}">
              @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
              <label class="form-label">Password *</label>
              <div class="input-group">
                <input type="password" name="password" id="password"
                       class="form-control @error('password') is-invalid @enderror">
                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                  <i class="bi bi-eye-slash" id="icon-password"></i>
                </button>
              </div>
              <div class="form-text">Minimal 8 karakter, harus mengandung huruf besar, kecil, dan angka.</div>
              @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div class="mb-3">
              <label class="form-label">Konfirmasi Password *</label>
              <div class="input-group">
                <input type="password" name="confirm_password" id="confirm"
                       class="form-control @error('confirm_password') is-invalid @enderror">
                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="confirm">
                  <i class="bi bi-eye-slash" id="icon-confirm"></i>
                </button>
              </div>
              @error('confirm_password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            {{-- Kota --}}
            <div class="mb-3">
              <label class="form-label">Kota</label>
              <input type="text" name="city" class="form-control" value="{{ old('city') }}">
            </div>

            {{-- Profesi --}}
            <div class="mb-3">
              <label class="form-label">Profesi</label>
              <input type="text" name="profession" class="form-control" value="{{ old('profession') }}">
            </div>

            {{-- Bio --}}
            <div class="mb-3">
              <label class="form-label">Bio</label>
              <textarea name="bio" class="form-control" rows="3">{{ old('bio') }}</textarea>
            </div>

            {{-- Minat --}}
            <div class="mb-3 position-relative">
              <div class="d-flex justify-content-between align-items-start">
                <label class="form-label">Minat (maksimal 3)</label>
                <div id="interests-limit-error" class="text-danger small ms-2" style="white-space: nowrap; display: none;"></div>
              </div>
              <div class="d-flex flex-wrap gap-2" id="interests-container">
                @foreach($interests as $index => $int)
                  @php
                    $selected = in_array($int->id, old('interests', []));
                    $checkboxId = 'interest_' . $index;
                  @endphp
                  <input type="checkbox" class="btn-check interest-checkbox" name="interests[]" id="{{ $checkboxId }}" value="{{ $int->id }}" autocomplete="off" {{ $selected ? 'checked' : '' }}>
                  <label class="btn btn-outline-primary" for="{{ $checkboxId }}">{{ $int->name }}</label>
                @endforeach
              </div>
              @error('interests')
                <div class="text-danger mt-1">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-outline-light">Daftar</button>
              <a href="{{ route('login') }}" class="btn btn-secondary">Sudah punya akun? Login</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</main>

{{-- Script: Toggle password + minat --}}
<script src="{{ asset('js/components/toggle_password.js') }}"></script>
<script>
  document.querySelectorAll('.interest-checkbox').forEach(cb => {
    cb.addEventListener('change', function () {
      const checked = document.querySelectorAll('.interest-checkbox:checked');
      const errorEl = document.getElementById('interests-limit-error');

      if (checked.length > 3) {
        this.checked = false;
        errorEl.textContent = 'Maksimal hanya bisa memilih 3 minat.';
        errorEl.style.display = 'inline';
        clearTimeout(errorEl._timeout);
        errorEl._timeout = setTimeout(() => {
          errorEl.style.display = 'none';
        }, 3000);
      }
    });
  });
</script>
@endsection
