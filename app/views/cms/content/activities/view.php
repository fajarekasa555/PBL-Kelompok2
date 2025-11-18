<div class="card mt-3 shadow-sm" style="border-radius:12px; overflow:hidden;">

    <!-- FOTO / DOKUMENTASI -->
    <div class="p-4 text-center bg-light">

        <?php if (!empty($activity['documentation'])): ?>

            <?php
                $baseUrl = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
                $filePath = $activity['documentation'];
                $fullUrl = $baseUrl . "/public/" . $filePath;
                $file = "public/" . $activity['documentation'];
                $ext  = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            ?>

            <?php if (in_array($ext, ['jpg','jpeg','png','gif','webp'])): ?>
                <img src="<?= $file ?>"
                    alt="Dokumentasi Kegiatan"
                    class="rounded mb-3"
                    style="width:100%; max-width:300px; height:auto; border:2px solid #ddd; border-radius:12px; object-fit:cover; transition: transform 0.3s;"
                    onmouseover="this.style.transform='scale(1.03)'"
                    onmouseout="this.style.transform='scale(1)'">

            <?php elseif (in_array($ext, ['pdf'])): ?>
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

        <h4 class="mb-0"><?= htmlspecialchars($activity['title']) ?></h4>
        <small class="text-muted">
            <?= !empty($activity['date']) ? date('d M Y', strtotime($activity['date'])) : '' ?>
        </small>
    </div>

    <!-- DETAIL -->
    <div class="p-3">

        <div class="row text-start mb-2">
            <div class="col-12 mb-2">
                <i class="fas fa-map-marker-alt me-2 text-danger"></i>
                <strong>Lokasi:</strong>
                <?= htmlspecialchars($activity['location'] ?? '-') ?>
            </div>
        </div>

        <hr class="my-2">

        <div class="mb-2 text-start">
            <strong>Deskripsi Kegiatan:</strong>
            <div class="mt-1">
                <?= !empty($activity['description']) 
                    ? nl2br(htmlspecialchars($activity['description'])) 
                    : '<span class="text-muted">Tidak ada deskripsi</span>' ?>
            </div>
        </div>

        <hr class="my-2">

        <div class="text-end text-muted" style="font-size:0.8rem;">
            Dibuat: <?= htmlspecialchars($activity['created_at']) ?>
        </div>

    </div>
</div>
