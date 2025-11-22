<div class="card mt-3 shadow-sm" style="border-radius:12px; overflow:hidden;">

    <!-- FOTO / DOKUMENTASI -->
    <div class="p-4 text-center bg-light">

        <?php if (!empty($project['documentation'])): ?>

            <?php
                $baseUrl = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
                $filePath = $project['documentation'];
                $fullUrl = $baseUrl . "/public/" . $filePath;
                $file = "public/" . $project['documentation'];
                $ext  = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            ?>

            <?php if (in_array($ext, ['jpg','jpeg','png','gif','webp'])): ?>
                <img src="<?= $file ?>"
                    alt="Dokumentasi Project"
                    class="rounded mb-3"
                    style="width:100%; max-width:300px; height:auto; border:2px solid #ddd; border-radius:12px; object-fit:cover; transition: transform 0.3s;"
                    onmouseover="this.style.transform='scale(1.03)'"
                    onmouseout="this.style.transform='scale(1)'">

            <?php elseif ($ext === 'pdf'): ?>
                <embed allow="fullscreen" src="<?= $file ?>#toolbar=1"
                    type="application/pdf"
                    width="100%"
                    height="400px"
                    class="border rounded mb-3" />

            <?php elseif (in_array($ext, ['doc','docx'])): ?>
                <iframe allow="fullscreen" src="https://docs.google.com/gview?url=<?= urlencode($fullUrl) ?>&embedded=true"
                        style="width:100%; height:400px;"
                        class="border rounded mb-3"></iframe>

            <?php else: ?>
                <div class="border p-3 rounded bg-white mb-3">
                    File tidak dapat ditampilkan.  
                    <br><a href="<?= $file ?>" download>Download File</a>
                </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="border d-flex align-items-center justify-content-center mx-auto mb-3"
                style="width:200px; height:140px; background:#f5f5f5; color:#999; font-weight:500; border-radius:12px;">
                Tidak ada dokumentasi
            </div>
        <?php endif; ?>

        <h4 class="mb-0"><?= htmlspecialchars($project['name']) ?></h4>
        <small class="text-muted">
            Deadline: 
            <?= !empty($project['deadline']) ? date('d M Y', strtotime($project['deadline'])) : '-' ?>
        </small>
    </div>

    <!-- DETAIL -->
    <div class="p-3">

        <!-- CLIENT -->
        <div class="row text-start mb-2">
            <div class="col-12 mb-2">
                <i class="fas fa-user-tie me-2 text-primary"></i>
                <strong>Client:</strong>
                <?= htmlspecialchars($project['client'] ?? '-') ?>
            </div>
        </div>

        <hr class="my-2">

        <!-- LOKASI -->
        <div class="row text-start mb-2">
            <div class="col-12">
                <i class="fas fa-map-marker-alt me-2 text-danger"></i>
                <strong>Lokasi:</strong>
                <?= htmlspecialchars($project['location'] ?? '-') ?>
            </div>
        </div>

        <hr class="my-2">

        <!-- DESKRIPSI -->
        <div class="mb-2 text-start">
            <strong>Deskripsi Project:</strong>
            <div class="mt-1">
                <?= !empty($project['description']) 
                    ? nl2br(htmlspecialchars($project['description'])) 
                    : '<span class="text-muted">Tidak ada deskripsi</span>' ?>
            </div>
        </div>

        <hr class="my-2">

        <!-- ANGGOTA -->
        <div class="mb-2">
            <strong>Member Proyek:</strong>
            <div class="mt-1">
                <?php if (!empty($members)): ?>
                    <?php foreach ($members as $member): ?>
                        <span class="badge bg-primary me-1 mb-1 px-2 py-1" style="font-size:0.85rem;">
                            <?= htmlspecialchars($member['name']) ?>
                        </span>
                    <?php endforeach; ?>
                <?php else: ?>
                    <span class="text-muted">Tidak ada anggota</span>
                <?php endif; ?>
            </div>
        </div>

        <hr class="my-2">

        <!-- CREATED -->
        <div class="text-end text-muted" style="font-size:0.8rem;">
            Dibuat: <?= htmlspecialchars($project['created_at']) ?>
        </div>

    </div>
</div>
