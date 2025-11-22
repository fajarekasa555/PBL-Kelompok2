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

<!-- Judul Project -->
<div class="mb-3 text-left">
    <label class="fw-semibold">Nama Project</label>
    <input type="text" 
           class="form-control" 
           name="name"
           value="<?= htmlspecialchars($project['name'] ?? '') ?>"
           placeholder="Masukkan nama project" 
           required>
</div>

<!-- Deskripsi -->
<div class="mb-3 text-left">
    <label class="fw-semibold">Deskripsi</label>
    <textarea class="form-control" 
              name="description" 
              rows="4"
              placeholder="Masukkan deskripsi project (opsional)"><?= htmlspecialchars($project['description'] ?? '') ?></textarea>
</div>

<!-- Tanggal mulai + selesai -->
<div class="row mb-3">
    <div class="col-md-6 text-left">
        <label class="fw-semibold">Tanggal Mulai</label>
        <input type="date" 
               class="form-control" 
               name="start_date"
               value="<?= htmlspecialchars($project['start_date'] ?? '') ?>">
    </div>

    <div class="col-md-6 text-left">
        <label class="fw-semibold">Tanggal Selesai</label>
        <input type="date" 
               class="form-control" 
               name="end_date"
               value="<?= htmlspecialchars($project['end_date'] ?? '') ?>">
    </div>
</div>

<!-- Sponsor -->
<div class="mb-3 text-left">
    <label class="fw-semibold">Sponsor</label>
    <input type="text" 
           class="form-control" 
           name="sponsor"
           value="<?= htmlspecialchars($project['sponsor'] ?? '') ?>"
           placeholder="Masukkan nama sponsor (opsional)">
</div>

<!-- Dokumentasi -->
<div class="mb-3 text-left">
    <label class="form-label fw-semibold">Dokumentasi (Foto / PDF / DOC)</label>
    <input type="hidden" id="existing_documentation" name="existing_documentation" value="<?= !empty($project['documentation']) ? 'public/' . $project['documentation'] : '' ?>">
    <input type="file" class="filepond" name="documentation" accept="image/*, application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
</div>

<!-- Members -->
<div class="mb-3 text-left">
    <label class="fw-semibold">Members</label>
    <select name="members[]" 
            id="members"
            class="multiple-select2 form-control select2-color-admin"
            multiple 
            required>
        
        <?php foreach ($allMembers as $member): ?>
            <option value="<?= $member['id'] ?>"
                <?= !empty($projectMembers) && in_array($member['id'], $projectMembers) ? 'selected' : '' ?>>
                <?= htmlspecialchars($member['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <small class="text-muted">Pilih member yang terlibat dalam project.</small>
</div>
