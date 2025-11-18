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

        <div class="text-end text-muted" style="font-size:0.8rem;">
            Dibuat: <?= htmlspecialchars($member['created_at']) ?>
        </div>
    </div>
</div>
