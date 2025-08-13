@extends('layouts.app')

@section('content')
<main class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-header card-header-dark">
          <h3 class="mb-0">Login ke ConnectCircle</h3>
        </div>
        <div class="card-body">

          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <form method="POST" action="{{ route('login.post') }}" novalidate autocomplete="off">
            @csrf

            <!-- Anti-autofill -->
            <input type="text" name="fakeusernameremembered" style="display:none">
            <input type="password" name="fakepasswordremembered" style="display:none">

            {{-- Email --}}
            <div class="mb-3">
              <label class="form-label">Email *</label>
              <input type="email" name="login_email"
                class="form-control @error('login_email') is-invalid @enderror"
                value="{{ old('login_email') }}" required autocomplete="off" autofocus>
              @error('login_email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
              <label class="form-label">Password *</label>
              <div class="input-group">
                <input type="password" name="login_password" id="password"
                  class="form-control @error('login_password') is-invalid @enderror"
                  autocomplete="new-password" required>
                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                  <i class="bi bi-eye-slash" id="icon-password"></i>
                </button>
              </div>
              @error('login_password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-outline-light">Login</button>  
              <a href="{{ route('register') }}" class="btn btn-secondary">Belum punya akun? Daftar</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</main>

<script src="{{ asset('js/components/toggle_password.js') }}"></script>
@endsection
