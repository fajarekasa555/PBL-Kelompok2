<?php
use App\Helpers\Routing;
$route = new Routing();

$baseUrl = $route->base_url('approval');
$filter = $filter ?? 'pending';
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Approval Mahasiswa</span>
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
        ajax: '<?= $baseUrl ?>?ajax=1&status=<?= $filter ?>',
        data: {
            ajax: 1,
            status: '<?= $filter ?>'
        },
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

function approveStudent(id) {
    Swal.fire({
        title: 'Approve Member?',
        input: 'textarea',
        inputLabel: 'Catatan (wajib diisi)',
        inputPlaceholder: 'Tulis catatan approval...',
        showCancelButton: true,
        confirmButtonText: 'Approve',
        preConfirm: (note) => {
            if (!note) Swal.showValidationMessage('Catatan wajib diisi');
            return note;
        }
    }).then((result) => {
        if (result.isConfirmed) {

            Swal.fire({
                title: 'Mengirim Email...',
                text: 'Mohon tunggu sebentar.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.post('<?= $baseUrl ?>/approve/' + id,
                { note: result.value },
                function(response) {

                    Swal.close(); // tutup loading

                    if (response.status === 'success') {
                        Swal.fire('Berhasil', 'Member telah disetujui.', 'success');
                        memberTable.ajax.reload(null, false);
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                'json'
            );
        }
    });
}


function rejectStudent(id) {
    Swal.fire({
        title: 'Tolak Member?',
        input: 'textarea',
        inputLabel: 'Catatan penolakan (wajib diisi)',
        inputPlaceholder: 'Tulis alasan penolakan...',
        showCancelButton: true,
        confirmButtonText: 'Reject',
        confirmButtonColor: '#d33',
        preConfirm: (note) => {
            if (!note) Swal.showValidationMessage('Alasan penolakan wajib diisi');
            return note;
        }
    }).then((result) => {
        if (result.isConfirmed) {

            Swal.fire({
                title: 'Mengirim Email...',
                text: 'Mohon tunggu sebentar.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.post('<?= $baseUrl ?>/reject/' + id,
                { note: result.value },
                function(response) {

                    Swal.close();

                    if (response.status === 'success') {
                        Swal.fire('Berhasil', 'Member telah ditolak.', 'success');
                        memberTable.ajax.reload(null, false);
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                'json'
            );
        }
    });
}


</script>
