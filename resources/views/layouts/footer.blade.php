</main> <!-- close main -->

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

    <small>&copy; <?= date('Y') ?> <strong>ConnectCircle</strong></small>
  </div>
</footer>

<!-- Modal Konfirmasi Hapus (Global) -->
<div class="modal fade" id="confirmRemoveModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header border-secondary">
        <h5 class="modal-title">Konfirmasi Hapus Pertemanan</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus <strong id="friend-name"></strong> dari daftar teman?</p>
      </div>
      <div class="modal-footer border-secondary">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" id="confirmRemoveBtn">Konfirmasi</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
