<?php
use App\Helpers\Routing;
$route = new Routing();

$baseUrl = $route->base_url('student/approve');
$filter = $filter ?? 'approved';
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Daftar Mahasiswa</span>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="member-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Status</th>
                    <th width="120" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
let memberTable;

$(function() {
    memberTable = $('#member-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: '<?= $baseUrl ?>?ajax=1',
        columns: [
            { data: 'nim' },
            { data: 'name' },
            { data: 'prodi' },
            { data: 'status', className: 'text-center' },
            { 
                data: 'action', 
                orderable: false, 
                searchable: false,
                className: 'text-center'
            }
        ]
    });
});

function showStudent(id) {
    $.get('<?= $route->base_url("student/show") ?>/' + id + '?ajax=1', function(html) {
        Swal.fire({
            title: 'Detail Mahasiswa',
            html: html,
            width: '600px'
        });
    });
}

function deleteStudent(id) {
    swalConfirm('Hapus data Mahasiswa ini?', function() {
        $.get(`<?= $baseUrl ?>/delete/${id}`)
            .done(() => {
                publicationsTable.ajax.reload(null, false);
                Swal.fire({
                    icon: 'success',
                    title: 'Dihapus',
                    text: 'Data Mahasiswa telah dihapus.',
                    timer: 1300,
                    showConfirmButton: false
                });
            })
            .fail(() => {
                Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data.', 'error');
            });
    });
}
</script>
