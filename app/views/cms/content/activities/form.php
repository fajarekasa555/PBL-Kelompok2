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
    <label>Judul Kegiatan</label>
    <input type="text" class="form-control" name="title"
        value="<?= htmlspecialchars($activity['title'] ?? '') ?>"
        placeholder="Masukkan judul kegiatan" required>
</div>

<div class="mb-3 text-left">
    <label>Deskripsi</label>
    <textarea class="form-control" name="description" rows="4"
        placeholder="Masukkan deskripsi kegiatan (opsional)"><?= htmlspecialchars($activity['description'] ?? '') ?></textarea>
</div>

<div class="row mb-3">
    <div class="col-md-6 text-left">
        <label>Lokasi</label>
        <input type="text" class="form-control" name="location"
            value="<?= htmlspecialchars($activity['location'] ?? '') ?>"
            placeholder="Masukkan lokasi kegiatan">
    </div>

    <div class="col-md-6 text-left">
        <label>Tanggal Kegiatan</label>
        <input type="date" class="form-control" name="date"
            value="<?= htmlspecialchars($activity['date'] ?? '') ?>">
    </div>
</div>

<div class="mb-3 text-left">
    <label class="form-label fw-semibold">Dokumentasi (Foto / PDF / DOC)</label>
    <input type="hidden" id="existing_documentation" name="existing_documentation" value="<?= !empty($activity['documentation']) ? 'public/' . $activity['documentation'] : '' ?>">
    <input type="file" class="filepond" name="documentation" accept="image/*, application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
</div>

<div class="mb-3 text-left">
    <label>Member</label>
    <select name="members[]" id="members"
            class="multiple-select2 form-control select2-color-admin"
            multiple required>
        <?php foreach ($allMembers as $member): ?>
            <option value="<?= $member['id'] ?>"
                <?= !empty($activityMembers) && in_array($member['id'], $activityMembers) ? 'selected' : '' ?>>
                <?= htmlspecialchars($member['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <small class="text-muted">Pilih satu atau lebih bidang keahlian.</small>
</div>
