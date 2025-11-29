<style>
    .file-input .form-control {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .file-input .input-group-text {
        background: #f5f7fb;
        border-left: none;
        cursor: pointer;
        transition: 0.2s;
    }

    .file-input .input-group-text:hover {
        background: #e8eef8;
    }
</style>

<div class="mb-3 text-left">
    <label>Slug Fasilitas <span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="slug"
        value="<?= htmlspecialchars($facility['slug'] ?? '') ?>"
        placeholder="Masukkan slug fasilitas" required>
</div>

<div class="mb-3 text-left">
    <label>Deskripsi <span class="text-danger">*</span></label>
    <textarea class="form-control" name="description" rows="4"
        placeholder="Masukkan deskripsi fasilitas"><?= htmlspecialchars($facility['description'] ?? '') ?></textarea>
</div>

<div class="mb-3 text-left">
    <label class="form-label fw-semibold">Gambar Fasilitas</label>
    <input type="hidden" id="existing_image" name="existing_image" 
        value="<?= !empty($facility['image']) ? 'public/' . $facility['image'] : '' ?>">
    <input type="file" class="filepond" name="image" accept="image/png, image/jpeg, image/jpg, image/webp">
    <small class="text-muted">Upload gambar fasilitas. Jika kosong saat edit, gambar lama tetap digunakan.</small>
</div>
