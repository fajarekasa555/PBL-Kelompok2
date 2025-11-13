    <div class="mb-3 text-left">
        <label>Nama Lengkap</label>
        <input type="text" class="form-control" name="name"
               value="<?= htmlspecialchars($members['name'] ?? '') ?>"
               placeholder="Masukkan nama lengkap" required>
    </div>

    <div class="mb-3 text-left">
        <label>Gelar Depan</label>
        <input type="text" class="form-control" name="title_prefix"
               value="<?= htmlspecialchars($members['title_prefix'] ?? '') ?>"
               placeholder="Contoh: Dr., Ir., Prof.">
    </div>

    <div class="mb-3 text-left">
        <label>Gelar Belakang</label>
        <input type="text" class="form-control" name="title_suffix"
               value="<?= htmlspecialchars($members['title_suffix'] ?? '') ?>"
               placeholder="Contoh: S.T., M.Kom., Ph.D.">
    </div>

    <div class="mb-3 text-left">
        <label>NIP</label>
        <input type="text" class="form-control" name="nip"
               value="<?= htmlspecialchars($members['nip'] ?? '') ?>"
               placeholder="Masukkan NIP">
    </div>

    <div class="mb-3 text-left">
        <label>NIDN</label>
        <input type="text" class="form-control" name="nidn"
               value="<?= htmlspecialchars($members['nidn'] ?? '') ?>"
               placeholder="Masukkan NIDN">
    </div>

    <div class="mb-3 text-left">
        <label>Program Studi</label>
        <input type="text" class="form-control" name="program_studi"
               value="<?= htmlspecialchars($members['program_studi'] ?? '') ?>"
               placeholder="Masukkan program studi">
    </div>

    <div class="mb-3 text-left">
        <label>Jabatan / Posisi</label>
        <input type="text" class="form-control" name="jabatan"
               value="<?= htmlspecialchars($members['jabatan'] ?? '') ?>"
               placeholder="Masukkan jabatan atau posisi" required>
    </div>

    <div class="mb-3 text-left">
        <label>Email</label>
        <input type="email" class="form-control" name="email"
               value="<?= htmlspecialchars($members['email'] ?? '') ?>"
               placeholder="Masukkan alamat email" required>
    </div>

    <div class="mb-3 text-left">
        <label>No. Telepon</label>
        <input type="text" class="form-control" name="phone"
               value="<?= htmlspecialchars($members['phone'] ?? '') ?>"
               placeholder="Masukkan nomor telepon">
    </div>

    <div class="mb-3 text-left">
        <label>Alamat</label>
        <textarea class="form-control" name="address"
                  placeholder="Masukkan alamat lengkap"><?= htmlspecialchars($members['address'] ?? '') ?></textarea>
    </div>

    <div class="mb-3 text-left">
        <label>Foto Anggota</label>
        <input type="file" class="form-control" name="photo" accept="image/*"
               <?= isset($members['id']) ? '' : 'required' ?>>

        <?php if (!empty($members['photo'])): ?>
            <div class="mt-2">
                <p>Foto saat ini:</p>
                <img src="public/<?= htmlspecialchars($members['photo']) ?>"
                     alt="Foto <?= htmlspecialchars($members['name'] ?? 'Anggota') ?>"
                     style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px; border: 1px solid #ccc;">
            </div>
        <?php endif; ?>
    </div>