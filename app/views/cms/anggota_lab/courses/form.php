<div class="mb-3 text-left">
    <label>Anggota / Dosen</label>
    <select class="form-control select2" name="member_id" required>
        <option value="">-- Pilih Anggota --</option>
        <?php foreach ($members as $m): ?>
            <option value="<?= $m['id'] ?>"
                <?= (isset($course['member_id']) && $course['member_id'] == $m['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($m['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="mb-3 text-left">
    <label>Semester</label>
    <select class="form-control select2" name="semester" required>
        <option value="">-- Pilih Semester --</option>
        <option value="Ganjil" <?= (($course['semester'] ?? '') === 'Ganjil') ? 'selected' : '' ?>>Ganjil</option>
        <option value="Genap" <?= (($course['semester'] ?? '') === 'Genap') ? 'selected' : '' ?>>Genap</option>
    </select>
</div>

<div class="mb-3 text-left">
    <label>Nama Mata Kuliah</label>
    <input 
        type="text" 
        class="form-control"
        name="course_name"
        value="<?= htmlspecialchars($course['course_name'] ?? '') ?>"
        placeholder="Contoh: Pemrograman Web"
        required
        autocomplete="off">
</div>