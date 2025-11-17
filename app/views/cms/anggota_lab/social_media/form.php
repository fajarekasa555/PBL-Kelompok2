<div class="mb-3 text-left">
    <label>Anggota / Dosen</label>
    <select class="form-control select2" name="member_id" required>
        <option value="">-- Pilih Anggota --</option>
        <?php foreach ($members as $m): ?>
            <option value="<?= $m['id'] ?>" 
                <?= (isset($social_media['member_id']) && $social_media['member_id'] == $m['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($m['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="mb-3 text-left">
    <label>Platform</label>
    <input type="text" class="form-control" name="platform" value="<?= htmlspecialchars($social_media['platform'] ?? '') ?>" placeholder="Contoh: Instagram, LinkedIn, YouTube" required>
</div>

<div class="mb-3 text-left">
    <label>Icon</label>
    <div class="d-flex align-items-center gap-2">
        <select class="form-control select2" name="icon" id="icon-select" required style="flex:1;">
            <option value="">-- Pilih Icon Platform --</option>

            <optgroup label="Font Awesome (Media Sosial)">
                <option value="fab fa-facebook" <?= (isset($social_media['icon']) && $social_media['icon'] === 'fab fa-facebook') ? 'selected' : '' ?>>Facebook</option>
                <option value="fab fa-instagram" <?= (isset($social_media['icon']) && $social_media['icon'] === 'fab fa-instagram') ? 'selected' : '' ?>>Instagram</option>
                <option value="fab fa-x-twitter" <?= (isset($social_media['icon']) && $social_media['icon'] === 'fab fa-x-twitter') ? 'selected' : '' ?>>X / Twitter</option>
                <option value="fab fa-linkedin" <?= (isset($social_media['icon']) && $social_media['icon'] === 'fab fa-linkedin') ? 'selected' : '' ?>>LinkedIn</option>
                <option value="fab fa-youtube" <?= (isset($social_media['icon']) && $social_media['icon'] === 'fab fa-youtube') ? 'selected' : '' ?>>YouTube</option>
                <option value="fab fa-researchgate" <?= (isset($social_media['icon']) && $social_media['icon'] === 'fab fa-researchgate') ? 'selected' : '' ?>>ResearchGate</option>
                <option value="fab fa-orcid" <?= (isset($social_media['icon']) && $social_media['icon'] === 'fab fa-orcid') ? 'selected' : '' ?>>ORCID</option>
                <option value="fab fa-github" <?= (isset($social_media['icon']) && $social_media['icon'] === 'fab fa-github') ? 'selected' : '' ?>>GitHub</option>
            </optgroup>

            <optgroup label="Font Awesome (Umum)">
                <option value="fas fa-graduation-cap" <?= (isset($social_media['icon']) && $social_media['icon'] === 'fas fa-graduation-cap') ? 'selected' : '' ?>>Google Scholar</option>
                <option value="fas fa-university" <?= (isset($social_media['icon']) && $social_media['icon'] === 'fas fa-university') ? 'selected' : '' ?>>Sinta</option>
                <option value="fas fa-envelope" <?= (isset($social_media['icon']) && $social_media['icon'] === 'fas fa-envelope') ? 'selected' : '' ?>>Email</option>
                <option value="fas fa-file-alt" <?= (isset($social_media['icon']) && $social_media['icon'] === 'fas fa-file-alt') ? 'selected' : '' ?>>CV / Dokumen</option>
                <option value="fas fa-globe" <?= (isset($social_media['icon']) && $social_media['icon'] === 'fas fa-globe') ? 'selected' : '' ?>>Website</option>
            </optgroup>
        </select>

    </div>
    <small class="text-muted">
        Pilih salah satu ikon dari daftar di atas.<br>
        Ikon berasal dari 
        <a href="https://fontawesome.com/icons" target="_blank">Font Awesome</a> 
        atau 
        <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>.
    </small>
</div>

<div class="mb-3 text-left">
    <label>Tautan URL</label>
    <input type="url" class="form-control" name="url" value="<?= htmlspecialchars($social_media['url'] ?? '') ?>" placeholder="https://contoh.com/profil" required>
</div>

