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

    .add-btn {
        cursor: pointer;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 20px;
    }

    .remove-btn {
        cursor: pointer;
        color: #dc3545;
        font-size: 24px;
        font-weight: bold;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 4px;
    }

    .remove-btn:hover {
        background: #ffe6e6;
        color: #c82333;
    }

    .dynamic-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        border: 1px solid #dee2e6;
    }

    .dynamic-section h5 {
        color: #495057;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #007bff;
    }

    .dynamic-row {
        background: white;
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 15px;
        border: 1px solid #e0e0e0;
        transition: all 0.2s;
    }

    .dynamic-row:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-color: #007bff;
    }

    .empty-state {
        text-align: center;
        padding: 30px;
        color: #6c757d;
        font-style: italic;
        display: none;
    }

    .empty-state.show {
        display: block;
    }

    .row-number {
        display: inline-block;
        background: #007bff;
        color: white;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        text-align: center;
        line-height: 24px;
        font-size: 12px;
        font-weight: bold;
        margin-right: 8px;
    }

    .social-icon-preview {
        color: #007bff;
        transition: all 0.3s;
    }

    .social-icon-input {
        background-color: #f8f9fa !important;
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-container .select2-selection--single {
        height: 38px !important;
        border: 1px solid #ced4da !important;
        border-radius: 0.25rem !important;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 36px !important;
        padding-left: 12px !important;
    }

    .select2-container .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }
</style>

<div class="mb-3 text-left">
    <label>Nama Lengkap <span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="name"
           value="<?= htmlspecialchars($members['name'] ?? '') ?>"
           placeholder="Masukkan nama lengkap" required>
</div>

<div class="row mb-3">
    <div class="col-md-6 text-left">
        <label class="form-label">Gelar Depan</label>
        <input type="text" class="form-control" name="title_prefix"
            value="<?= htmlspecialchars($members['title_prefix'] ?? '') ?>"
            placeholder="Contoh: Dr., Ir., Prof.">
    </div>

    <div class="col-md-6 text-left">
        <label class="form-label">Gelar Belakang</label>
        <input type="text" class="form-control" name="title_suffix"
            value="<?= htmlspecialchars($members['title_suffix'] ?? '') ?>"
            placeholder="Contoh: S.T., M.Kom., Ph.D.">
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6 text-left">
        <label>NIP</label>
        <input type="text" class="form-control" name="nip"
            value="<?= htmlspecialchars($members['nip'] ?? '') ?>"
            placeholder="Masukkan NIP">
    </div>

    <div class="col-md-6 text-left">
        <label>NIDN</label>
        <input type="text" class="form-control" name="nidn"
            value="<?= htmlspecialchars($members['nidn'] ?? '') ?>"
            placeholder="Masukkan NIDN">
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6 text-left">
        <label>Program Studi</label>
        <input type="text" class="form-control" name="program_studi"
            value="<?= htmlspecialchars($members['program_studi'] ?? '') ?>"
            placeholder="Masukkan program studi">
    </div>
    <div class="col-md-6">
        <label class="form-label">Jabatan / Posisi <span class="text-danger">*</span></label>
        <select class="form-control select2-jabatan" name="jabatan" required>
            <option value="">-- Pilih Jabatan --</option>
            <option value="ketua"   <?= ($members['jabatan'] ?? '') == 'ketua' ? 'selected' : '' ?>>Ketua</option>
            <option value="wakil"   <?= ($members['jabatan'] ?? '') == 'wakil' ? 'selected' : '' ?>>Wakil</option>
            <option value="anggota" <?= ($members['jabatan'] ?? '') == 'anggota' ? 'selected' : '' ?>>Anggota</option>
        </select>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6 text-left">
        <label>Email <span class="text-danger">*</span></label>
        <input type="email" class="form-control" name="email"
            value="<?= htmlspecialchars($members['email'] ?? '') ?>"
            placeholder="Masukkan alamat email" required>
    </div>

    <div class="col-md-6 text-left">
        <label>No. Telepon</label>
        <input type="text" class="form-control" name="phone"
            value="<?= htmlspecialchars($members['phone'] ?? '') ?>"
            placeholder="Masukkan nomor telepon">
    </div>
</div>

<div class="mb-3 text-left">
    <label>Bidang Keahlian (Expertise) <span class="text-danger">*</span></label>
    <select name="expertises[]" id="expertises"
            class="multiple-select2 form-control select2-color-admin"
            multiple required>
        <?php foreach ($allExpertises as $exp): ?>
            <option value="<?= $exp['id'] ?>"
                <?= !empty($memberExpertises) && in_array($exp['id'], $memberExpertises) ? 'selected' : '' ?>>
                <?= htmlspecialchars($exp['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <small class="text-muted">Pilih satu atau lebih bidang keahlian.</small>
</div>

<div class="mb-3 text-left">
    <label>Alamat</label>
    <textarea class="form-control" name="address" rows="6"
              placeholder="Masukkan alamat lengkap"><?= htmlspecialchars($members['address'] ?? '') ?></textarea>
</div>

<div class="mb-3 text-left">
    <input type="hidden" id="existing_photo" name="existing_photo" value="<?= isset($members) && isset($members['photo']) != '' ? $members['photo'] : '' ?>">
    <label class="form-label fw-semibold">Foto Anggota</label>
    <input type="file" class="filepond" name="photo" accept="image/*">
</div>

<div class="dynamic-section">
    <h5><i class="fas fa-share-alt me-2"></i>Media Sosial</h5>
    <div id="social-container"></div>
    <div class="empty-state" id="social-empty">
        <i class="fas fa-users fa-3x mb-2"></i>
        <p>Belum ada media sosial yang ditambahkan</p>
    </div>
    <button type="button" class="btn btn-primary add-btn" id="add-social">
        <i class="fas fa-plus me-1"></i> Tambah Media Sosial
    </button>
</div>

<div class="dynamic-section">
    <h5><i class="fas fa-certificate me-2"></i>Sertifikasi</h5>
    <div id="cert-container"></div>
    <div class="empty-state" id="cert-empty">
        <i class="fas fa-award fa-3x mb-2"></i>
        <p>Belum ada sertifikasi yang ditambahkan</p>
    </div>
    <button type="button" class="btn btn-primary add-btn" id="add-cert">
        <i class="fas fa-plus me-1"></i> Tambah Sertifikasi
    </button>
</div>

<div class="dynamic-section">
    <h5><i class="fas fa-graduation-cap me-2"></i>Riwayat Pendidikan</h5>
    <div id="edu-container"></div>
    <div class="empty-state" id="edu-empty">
        <i class="fas fa-book fa-3x mb-2"></i>
        <p>Belum ada riwayat pendidikan yang ditambahkan</p>
    </div>
    <button type="button" class="btn btn-primary add-btn" id="add-edu">
        <i class="fas fa-plus me-1"></i> Tambah Pendidikan
    </button>
</div>

<div class="dynamic-section">
    <h5><i class="fas fa-chalkboard-teacher me-2"></i>Mata Kuliah Diampu</h5>
    <div id="course-container"></div>
    <div class="empty-state" id="course-empty">
        <i class="fas fa-book-open fa-3x mb-2"></i>
        <p>Belum ada mata kuliah yang ditambahkan</p>
    </div>
    <button type="button" class="btn btn-primary add-btn" id="add-course">
        <i class="fas fa-plus me-1"></i> Tambah Mata Kuliah
    </button>
</div>
