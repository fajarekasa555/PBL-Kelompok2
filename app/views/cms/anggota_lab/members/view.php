<div class="card mt-3 p-3">
    <div class="row">
        <div class="col-md-12 text-center">
            <?php if (!empty($member['photo'])): ?>
                <img src="public/<?= htmlspecialchars($member['photo']) ?>" alt="Foto" class="img-fluid rounded" style="width:150px; height:150px; object-fit:cover;">
            <?php else: ?>
                <div class="border rounded m-4 p-4 bg-light text-muted">Tidak ada foto</div>
            <?php endif; ?>
        </div>
        <div class="col-md-12">
            <table class="table table-borderless text-left">
                <tr>
                    <th>NIP</th>
                    <td><?= htmlspecialchars($member['nip'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>NIDN</th>
                    <td><?= htmlspecialchars($member['nidn'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Nama Lengkap</th>
                    <td><?= htmlspecialchars($member['name']) ?></td>
                </tr>
                <tr>
                    <th>Gelar</th>
                    <td><?= htmlspecialchars(($member['title_prefix'] ?? '') . ' ' . ($member['title_suffix'] ?? '')) ?></td>
                </tr>
                <tr>
                    <th>Program Studi</th><td><?= htmlspecialchars($member['program_studi'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td><?= htmlspecialchars($member['jabatan'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($member['email'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Telepon</th>
                    <td><?= htmlspecialchars($member['phone'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?= htmlspecialchars($member['address'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Dibuat</th>
                    <td><?= htmlspecialchars($member['created_at']) ?></td>
                </tr>
                <tr>
                    <th>Bidang Keahlian</th>
                    <td>
                        <?php if (!empty($expertises)): ?>
                            <?php foreach ($expertises as $exp): ?>
                                <span class="badge bg-primary px-3 py-2"
                                    style="font-size: 0.9rem; margin-right: 4px; margin-bottom: 4px;">
                                    <?= htmlspecialchars($exp['name']) ?>
                                </span>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="text-muted">Tidak ada bidang keahlian</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
