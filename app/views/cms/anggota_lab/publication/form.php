<div class="mb-3 text-left">
    <label>Judul Publikasi <span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($publications['title'] ?? '') ?>" placeholder="Masukkan judul publikasi" required autocomplete="off">
</div>
<div class="mb-3 text-left">
    <label>Tanggal Publikasi <span class="text-danger">*</span></label>
    <input type="date" class="form-control datepicker" name="date" value="<?= $publications['date'] ?? '' ?>" required>
</div>
<div class="mb-3 text-left">
    <label>Tautan Publikasi <span class="text-danger">*</span></label>
    <input type="url" class="form-control" name="link" value="<?= htmlspecialchars($publications['link'] ?? '') ?>" placeholder="https://contoh.com/publikasi" required>
</div>
<div class="mb-3 text-left">
    <label>Anggota / Dosen <span class="text-danger">*</span></label>
    <select class="form-control select2" name="member_id" required>
        <option value="">-- Pilih Anggota --</option>
        <?php foreach ($members as $m): ?>
            <option value="<?= $m['id'] ?>" 
                <?= (isset($publications['member_id']) && $publications['member_id'] == $m['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($m['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>