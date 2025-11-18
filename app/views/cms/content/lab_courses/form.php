<div class="mb-3 text-left">
    <label>Nama Mata Kuliah</label>
    <input type="text" class="form-control" id="name" name="name" value="<?= $course['name'] ?? '' ?>" placeholder="Masukkan nama course" required>
</div>

<div class="mb-3 text-left">
    <label>Deskripsi</label>
    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Masukkan deskripsi mata kuliah (opsional)"><?= $course['description'] ?? '' ?></textarea>
</div>
