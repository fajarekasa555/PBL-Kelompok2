<div class="card mt-3 shadow-sm" style="border-radius:12px; overflow:hidden;">

    <div class="p-4 text-center bg-light">

        <?php if (!empty($facility['image'])): ?>

            <?php
                $baseUrl = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
                $filePath = $facility['image'];
                $fullUrl = $baseUrl . "/public/" . $filePath;
                $file = "public/" . $facility['image'];
                $ext  = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            ?>

            <?php if (in_array($ext, ['jpg','jpeg','png','gif','webp'])): ?>
                <img src="<?= $file ?>"
                    alt="Gambar Fasilitas"
                    class="rounded mb-3"
                    style="width:100%; max-width:300px; height:auto; border:2px solid #ddd; border-radius:12px; object-fit:cover; transition: transform 0.3s;"
                    onmouseover="this.style.transform='scale(1.03)'"
                    onmouseout="this.style.transform='scale(1)'">
            <?php else: ?>
                <div class="border p-3 rounded bg-white mb-3">
                    File tidak dapat ditampilkan.  
                    <br><a href="<?= $file ?>" download>Download File</a>
                </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="border d-flex align-items-center justify-content-center mx-auto mb-3"
                style="width:200px; height:140px; background:#f5f5f5; color:#999; font-weight:500; border-radius:12px;">
                Tidak ada gambar
            </div>
        <?php endif; ?>

        <h4 class="mb-0"><?= htmlspecialchars($facility['slug']) ?></h4>
    </div>

    <!-- DETAIL FASILITAS -->
    <div class="p-3">

        <div class="mb-2 text-start">
            <strong>Deskripsi Fasilitas:</strong>
            <div class="mt-1">
                <?= !empty($facility['description']) 
                    ? nl2br(htmlspecialchars($facility['description'])) 
                    : '<span class="text-muted">Tidak ada deskripsi</span>' ?>
            </div>
        </div>

        <hr class="my-2">

        <div class="text-end text-muted" style="font-size:0.8rem;">
            Dibuat: <?= htmlspecialchars($facility['created_at'] ?? '-') ?>
        </div>

    </div>
</div>
