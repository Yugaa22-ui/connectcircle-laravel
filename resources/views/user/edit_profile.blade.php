@extends('layouts.app')

@section('content')
<main class="container py-5">

    <link href="{{ asset('css/cropper-style.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">

  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-sm bg-dark text-white">
        <div class="card-header border-secondary">
          <h3 class="mb-0">Edit Profil</h3>
        </div>
        <div class="card-body">

          {{-- Pesan sukses / error --}}
          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          @if($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $err)
                  <li>{{ $err }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf

            <div class="mb-3">
              <label class="form-label">Username *</label>
              <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Email *</label>
              <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Kota</label>
              <input type="text" name="city" class="form-control" value="{{ old('city', $user->city) }}">
            </div>

            <div class="mb-3">
              <label class="form-label">Profesi</label>
              <input type="text" name="profession" class="form-control" value="{{ old('profession', $user->profession) }}">
            </div>

            <div class="mb-3">
              <label class="form-label">Bio</label>
              <textarea name="bio" class="form-control" rows="3">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <div class="mb-3">
              <label class="form-label">Minat (maksimal 3)</label>
              <div class="d-flex flex-wrap gap-2" id="interests-container">
                @foreach ($all_interests as $index => $int)
                  @php
                    $selected = in_array($int->id, $user_interests);
                    $checkboxId = 'interest_' . $index;
                  @endphp
                  <input type="checkbox" class="btn-check interest-checkbox" name="interests[]" id="{{ $checkboxId }}" value="{{ $int->id }}" {{ $selected ? 'checked' : '' }}>
                  <label class="btn btn-outline-info text-white" for="{{ $checkboxId }}">{{ $int->name }}</label>
                @endforeach
              </div>
              <div id="interest-error" class="form-error mt-2 d-none text-danger">Maksimal hanya bisa memilih 3 minat.</div>
            </div>

            <div class="mb-3">
              <label class="form-label">Foto Profil</label><br>
              @if($user->profile_picture)
                <img id="preview" src="{{ asset('storage/uploads/'.$user->profile_picture) }}" class="rounded-circle mb-2" width="100">
              @else
                <img id="preview" class="d-none rounded-circle mb-2" width="100">
              @endif
              <input type="file" name="profile_picture" id="profileInput" class="form-control" accept="image/*">
              <input type="hidden" name="cropped_image" id="cropped_image_input">
            </div>

            <div class="d-flex justify-content-between flex-wrap gap-2">
              <button type="submit" class="btn btn-outline-light">Simpan Perubahan</button>
              <a href="{{ route('profile.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

{{-- Modal Cropper --}}
<div class="modal fade" id="cropperModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header border-secondary">
        <h5 class="modal-title">Crop Foto Profil</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <img id="cropperImage" class="img-fluid" src="">
      </div>
      <div class="modal-footer border-secondary">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-outline-light" id="cropBtn">Simpan</button>
      </div>
    </div>
  </div>
</div>

{{-- Script --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script src="{{ asset('js/components/cropper-handler.js') }}"></script>
<script src="{{ asset('js/user/limit_interest.js') }}"></script>
@endsection
