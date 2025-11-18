<div class="mb-3 text-left">
    <label>Judul Research</label>
    <input type="text" class="form-control" id="title" name="title" value="<?= $focus['title'] ?? '' ?>" placeholder="Masukkan judul research" required>
</div>

<div class="mb-3 text-left">
    <label>Bidang</label>
    <input type="text" class="form-control" id="field" name="field" value="<?= $focus['field'] ?? '' ?>" placeholder="Contoh: AI, Robotics, IoT, Data Science">
</div>

<div class="mb-3 text-left">
    <label>Deskripsi</label>
    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Masukkan deskripsi research (opsional)"><?= $focus['description'] ?? '' ?></textarea>
</div>
