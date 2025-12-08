<?php
use App\Helpers\Routing;
$route = new Routing();
$baseFileUrl = $route->base_url();
?>

<div class="panel panel-default">
    <div class="panel-body">

        <table class="table table-bordered">
            <tr>
                <th width="200">NIM</th>
                <td><?= htmlspecialchars($student['nim']) ?></td>
            </tr>

            <tr>
                <th>Nama</th>
                <td><?= htmlspecialchars($student['name']) ?></td>
            </tr>

            <tr>
                <th>Program Studi</th>
                <td><?= htmlspecialchars($student['program_studi']) ?></td>
            </tr>

            <tr>
                <th>Semester</th>
                <td><?= htmlspecialchars($student['semester']) ?></td>
            </tr>

            <tr>
                <th>IPK</th>
                <td><?= htmlspecialchars($student['ipk']) ?></td>
            </tr>

            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($student['email']) ?></td>
            </tr>

            <tr>
                <th>No HP</th>
                <td><?= htmlspecialchars($student['phone'] ?? '-') ?></td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    <?php if ($student['status'] == 'approved'): ?>
                        <span class="badge bg-success">Approved</span>
                    <?php elseif ($student['status'] == 'rejected'): ?>
                        <span class="badge bg-danger">Rejected</span>
                    <?php else: ?>
                        <span class="badge bg-secondary">Pending</span>
                    <?php endif; ?>
                </td>
            </tr>

            <tr>
                <th>Tanggal Daftar</th>
                <td><?= htmlspecialchars($student['created_at']) ?></td>
            </tr>

            <!-- CV FILE -->
            <tr>
                <th>Curriculum Vitae (CV)</th>
                <td>
                    <?php if (!empty($student['cv_path'])): ?>
                        <a href="<?= $baseFileUrl . $student['cv_path'] ?>" class="btn btn-primary btn-sm" target="_blank">
                            <i class="fa fa-download"></i> Download CV
                        </a>

                        <?php if (preg_match('/\.(pdf)$/', $student['cv_path'])): ?>
                            <a href="<?= $baseFileUrl . $student['cv_path'] ?>" class="btn btn-info btn-sm" target="_blank">
                                <i class="fa fa-eye"></i> Preview
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="text-muted">Tidak ada file</span>
                    <?php endif; ?>
                </td>
            </tr>

            <tr>
                <th>Portfolio</th>
                <td>
                    <?php if (!empty($student['portfolio_path'])): ?>
                        <a href="<?= $baseFileUrl . $student['portfolio_path'] ?>" class="btn btn-primary btn-sm" target="_blank">
                            <i class="fa fa-download"></i> Download Portfolio
                        </a>

                        <?php if (preg_match('/\.(pdf|jpg|jpeg|png)$/', $student['portfolio_path'])): ?>
                            <a href="<?= $baseFileUrl . $student['portfolio_path'] ?>" class="btn btn-info btn-sm" target="_blank">
                                <i class="fa fa-eye"></i> Preview
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="text-muted">Tidak ada portfolio</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Motivation</th>
                <td><?= nl2br(htmlspecialchars($student['motivation'])) ?></td>
            </tr>

            <?php if (!empty($student['note'])): ?>
            <tr>
                <th>Catatan Admin</th>
                <td><?= nl2br(htmlspecialchars($student['note'])) ?></td>
            </tr>
            <?php endif; ?>

        </table>


    </div>
</div>

<style>
.table th {
    background: #f5f5f5;
}
</style>
