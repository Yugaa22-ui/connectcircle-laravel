<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'ConnectCircle')</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Custom Dark Theme -->
  <link rel="stylesheet" href="{{ asset('css/dark-theme.css') }}" />
</head>
<body class="bg-dark text-white d-flex flex-column min-vh-100">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary">
  <div class="container d-flex align-items-center">
    <img src="{{ asset('assets/img/logo_aplikasi.svg') }}" alt="Logo ConnectCircle" class="logo-image" />
  </div>
</nav>

<!-- Main Content -->
<main class="flex-grow-1">
  @yield('content')
</main>

<!-- Footer -->
<footer class="bg-dark border-top border-secondary text-white-50 py-3 mt-auto">
  <div class="container text-center">
    <div class="mb-2 small">
      <a href="#" class="text-white-50 text-decoration-none me-3">Tentang</a>
      <a href="#" class="text-white-50 text-decoration-none me-3">Bantuan</a>
      <a href="#" class="text-white-50 text-decoration-none me-3">Kebijakan Privasi</a>
      <a href="#" class="text-white-50 text-decoration-none">Ketentuan Layanan</a>
    </div>
    
    <div class="mb-1">
      <a href="https://github.com/Yugaa22-ui/connectcircle" target="_blank" class="text-white-50 text-decoration-none me-3" title="GitHub">
        <i class="bi bi-github fs-5"></i>
      </a>
      <a href="https://mail.google.com/mail/?view=cm&to=laluyoga2704@gmail.com" target="_blank" class="text-white-50 text-decoration-none me-3" title="Kirim Email via Gmail">
        <i class="bi bi-envelope-fill fs-5"></i>
      </a>
      <a href="https://www.instagram.com/alpredofx/" target="_blank" class="text-white-50 text-decoration-none me-3" title="Instagram">
        <i class="bi bi-instagram fs-5"></i>
      </a>
      <a href="https://wa.me/6281237082141" target="_blank" class="text-white-50 text-decoration-none me-3" title="WhatsApp">
        <i class="bi bi-whatsapp fs-5"></i>
      </a>
    </div>

    <small>&copy; {{ date('Y') }} <strong>ConnectCircle</strong></small>
  </div>
</footer>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
