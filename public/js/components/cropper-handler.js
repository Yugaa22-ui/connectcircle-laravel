let cropper;
const fileInput = document.getElementById('profileInput');
const image = document.getElementById('cropperImage');
const preview = document.getElementById('preview');
const cropperModal = new bootstrap.Modal(document.getElementById('cropperModal'));
const croppedImageInput = document.getElementById('cropped_image_input');

fileInput.addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (event) {
        image.src = event.target.result;
        image.onload = function () {
            cropperModal.show();
        };
    };
    reader.readAsDataURL(file);
});

document.getElementById('cropperModal').addEventListener('shown.bs.modal', function () {
    if (cropper) cropper.destroy();
    cropper = new Cropper(image, {
        aspectRatio: 1,
        initialAspectRatio: 1,
        viewMode: 2,
        autoCropArea: 1,
        dragMode: 'move',
        movable: true,
        zoomable: true,
        rotatable: false,
        scalable: false,
        responsive: true
    });
});

document.getElementById('cropperModal').addEventListener('hidden.bs.modal', function () {
    if (cropper) {
        cropper.destroy();
        cropper = null;
    }
});

document.getElementById('cropBtn').addEventListener('click', function () {
    if (!cropper) return;

    const canvas = cropper.getCroppedCanvas({
        width: 300,
        height: 300
    });

    // Simpan ke hidden input sebagai Base64
    croppedImageInput.value = canvas.toDataURL('image/png');

    // Preview langsung di halaman edit profil
    preview.src = canvas.toDataURL('image/png');
    preview.classList.remove('d-none');

    cropperModal.hide();
});
