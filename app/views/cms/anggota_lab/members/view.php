<div class="card mt-3 shadow-sm" style="border-radius:12px; overflow:hidden;">
    <div class="p-4 text-center bg-light">
        <?php if (!empty($member['photo'])): ?>
            <img src="public/<?= $member['photo'] ?>" 
                 alt="Foto" class="rounded-circle mb-3" 
                 style="width:120px; height:120px; object-fit:cover; border:2px solid #ddd; transition: transform 0.3s;"
                 onmouseover="this.style.transform='scale(1.1)'" 
                 onmouseout="this.style.transform='scale(1)'">
        <?php else: ?>
            <div class="rounded-circle border d-flex align-items-center justify-content-center mx-auto mb-3"
                 style="width:120px; height:120px; background:#f5f5f5; color:#999; font-weight:500;">
                Tidak ada foto
            </div>
        <?php endif; ?>
        <h5 class="mb-0"><?= htmlspecialchars($member['name']) ?></h5>
        <small class="text-muted">
            <?= htmlspecialchars(($member['title_prefix'] ?? '') . ' ' . ($member['title_suffix'] ?? '')) ?>
        </small>
    </div>

    <div class="p-3">
        <div class="row text-start mb-2">
            <div class="col-6 mb-2">
                <i class="fas fa-id-card me-2 text-primary"></i>
                <strong>NIP:</strong> <?= htmlspecialchars($member['nip'] ?? '-') ?>
            </div>
            <div class="col-6 mb-2">
                <i class="fas fa-id-badge me-2 text-primary"></i>
                <strong>NIDN:</strong> <?= htmlspecialchars($member['nidn'] ?? '-') ?>
            </div>
            <div class="col-6 mb-2">
                <i class="fas fa-graduation-cap me-2 text-success"></i>
                <strong>Prodi:</strong> <?= htmlspecialchars($member['program_studi'] ?? '-') ?>
            </div>
            <div class="col-6 mb-2">
                <i class="fas fa-briefcase me-2 text-warning"></i>
                <strong>Jabatan:</strong> <?= htmlspecialchars($member['jabatan'] ?? '-') ?>
            </div>
        </div>

        <hr class="my-2">

        <div class="row text-start mb-2">
            <div class="col-12 mb-1">
                <i class="fas fa-envelope me-2 text-danger"></i>
                <strong>Email:</strong> <?= htmlspecialchars($member['email'] ?? '-') ?>
            </div>
            <div class="col-12 mb-1">
                <i class="fas fa-phone me-2 text-info"></i>
                <strong>Telepon:</strong> <?= htmlspecialchars($member['phone'] ?? '-') ?>
            </div>
            <div class="col-12 mb-1">
                <i class="fas fa-map-marker-alt me-2 text-secondary"></i>
                <strong>Alamat:</strong> <?= htmlspecialchars($member['address'] ?? '-') ?>
            </div>
        </div>

        <hr class="my-2">

        <div class="mb-2">
            <strong>Bidang Keahlian:</strong>
            <div class="mt-1">
                <?php if (!empty($expertises)): ?>
                    <?php foreach ($expertises as $exp): ?>
                        <span class="badge bg-primary me-1 mb-1 px-2 py-1" style="font-size:0.85rem;">
                            <?= htmlspecialchars($exp['name']) ?>
                        </span>
                    <?php endforeach; ?>
                <?php else: ?>
                    <span class="text-muted">Tidak ada bidang keahlian</span>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($social)): ?>
        <hr class="my-2">
        <div class="mb-2">
            <strong>Media Sosial:</strong>
            <div class="mt-1">
                <?php foreach ($social as $s): ?>
                    <a href="<?= htmlspecialchars($s['url']) ?>" target="_blank" 
                       class="badge bg-secondary me-1 mb-1 px-2 py-1 text-decoration-none" 
                       style="font-size:0.85rem;">
                        <?php if (!empty($s['icon'])): ?>
                            <i class="<?= htmlspecialchars($s['icon']) ?>"></i>
                        <?php else: ?>
                            <i class="fab fa-<?= strtolower($s['platform']) ?>"></i>
                        <?php endif; ?>
                        <?= htmlspecialchars($s['platform']) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($education)): ?>
        <hr class="my-2">
        <div class="mb-2">
            <strong>Riwayat Pendidikan:</strong>
            <div class="mt-2">
                <?php foreach ($education as $edu): ?>
                    <div class="mb-2 ps-2 border-start border-primary border-3">
                        <div class="fw-bold"><?= htmlspecialchars($edu['degree']) ?></div>
                        <?php if (!empty($edu['major'])): ?>
                            <small class="text-muted"><?= htmlspecialchars($edu['major']) ?></small><br>
                        <?php endif; ?>
                        <small><?= htmlspecialchars($edu['institution']) ?></small><br>
                        <small class="text-muted">
                            <?= htmlspecialchars($edu['start_year']) ?> - <?= htmlspecialchars($edu['end_year'] ?? 'Sekarang') ?>
                        </small>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($certifications)): ?>
        <hr class="my-2">
        <div class="mb-2">
            <strong>Sertifikasi:</strong>
            <div class="mt-2">
                <?php foreach ($certifications as $cert): ?>
                    <div class="mb-2 ps-2 border-start border-warning border-3">
                        <div class="fw-bold"><?= htmlspecialchars($cert['title']) ?></div>
                        <?php if (!empty($cert['issuer'])): ?>
                            <small class="text-muted"><?= htmlspecialchars($cert['issuer']) ?></small><br>
                        <?php endif; ?>
                        <?php if (!empty($cert['issue_date'])): ?>
                            <small class="text-muted">
                                Diterbitkan: <?= date('d M Y', strtotime($cert['issue_date'])) ?>
                            </small>
                        <?php endif; ?>
                        <?php if (!empty($cert['expiration_date'])): ?>
                            <br><small class="text-muted">
                                Berlaku hingga: <?= date('d M Y', strtotime($cert['expiration_date'])) ?>
                            </small>
                        <?php endif; ?>
                        <?php if (!empty($cert['credential_id'])): ?>
                            <br><small class="text-muted">ID: <?= htmlspecialchars($cert['credential_id']) ?></small>
                        <?php endif; ?>
                        <?php if (!empty($cert['credential_url'])): ?>
                            <br><a href="<?= htmlspecialchars($cert['credential_url']) ?>" 
                                   target="_blank" class="small text-decoration-none">
                                <i class="fas fa-external-link-alt"></i> Lihat Kredensial
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($courses)): ?>
        <hr class="my-2">
        <div class="mb-2">
            <strong>Mata Kuliah yang Diampu:</strong>
            <div class="mt-1">
                <?php foreach ($courses as $course): ?>
                    <span class="badge bg-info me-1 mb-1 px-2 py-1" style="font-size:0.85rem;">
                        <?= htmlspecialchars($course['course_name']) ?>
                        <?php if (!empty($course['semester'])): ?>
                            (<?= htmlspecialchars($course['semester']) ?>)
                        <?php endif; ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="text-end text-muted" style="font-size:0.8rem;">
            Dibuat: <?= htmlspecialchars($member['created_at']) ?>
        </div>
    </div>
</div>