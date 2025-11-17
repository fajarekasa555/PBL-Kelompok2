    <div class="mb-3 text-left">
        <label>Anggota / Dosen</label>
        <select class="form-control select2" name="member_id" required>
            <option value="">-- Pilih Anggota --</option>
            <?php foreach ($members as $m): ?>
                <option value="<?= $m['id'] ?>" 
                    <?= (isset($education['member_id']) && $education['member_id'] == $m['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($m['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3 text-left">
        <label>Jenjang Pendidikan</label>
        <select class="form-control select2" name="degree" required>
            <option value="">-- Pilih Jenjang --</option>
            <?php 
            $degrees = ['D3', 'D4', 'S1', 'S2', 'S3'];
            foreach ($degrees as $deg): ?>
                <option value="<?= $deg ?>" 
                    <?= (isset($education['degree']) && $education['degree'] == $deg) ? 'selected' : '' ?>>
                    <?= $deg ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3 text-left">
        <label>Jurusan / Program Studi</label>
        <input 
            type="text" 
            class="form-control" 
            name="major" 
            value="<?= htmlspecialchars($education['major'] ?? '') ?>" 
            placeholder="Contoh: Teknik Informatika" 
            required 
            autocomplete="off">
    </div>

    <div class="mb-3 text-left">
        <label>Institusi / Universitas</label>
        <input 
            type="text" 
            class="form-control" 
            name="institution" 
            value="<?= htmlspecialchars($education['institution'] ?? '') ?>" 
            placeholder="Contoh: Politeknik Negeri Malang" 
            required 
            autocomplete="off">
    </div>

    <div class="row">
        <div class="col-md-6 mb-3 text-left">
            <label>Tahun Mulai</label>
            <input 
                type="number" 
                class="form-control" 
                name="start_year" 
                value="<?= htmlspecialchars($education['start_year'] ?? '') ?>" 
                placeholder="Contoh: 2019" 
                min="1950" 
                max="<?= date('Y') ?>" 
                required>
        </div>
        <div class="col-md-6 mb-3 text-left">
            <label>Tahun Selesai</label>
            <input 
                type="number" 
                class="form-control" 
                name="end_year" 
                value="<?= htmlspecialchars($education['end_year'] ?? '') ?>" 
                placeholder="Contoh: 2023" 
                min="1950" 
                max="<?= date('Y') + 10 ?>" 
                required>
        </div>
    </div>