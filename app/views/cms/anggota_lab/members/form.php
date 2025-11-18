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
        <label>Nama Lengkap</label>
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

        <div class="col-md-6 text-left">
            <label>Jabatan / Posisi</label>
            <input type="text" class="form-control" name="jabatan"
                value="<?= htmlspecialchars($members['jabatan'] ?? '') ?>"
                placeholder="Masukkan jabatan atau posisi" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6 text-left">
            <label>Email</label>
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
        <label>Bidang Keahlian (Expertise)</label>
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
        <input type="hidden" id="existing_photo" name="existing_photo" value="<?= $members['photo'] != '' ? 'public/' . $members['photo'] : '' ?>">
        <label class="form-label fw-semibold">Foto Anggota</label>
        <input type="file" class="filepond" name="photo" accept="image/*">
    </div>

