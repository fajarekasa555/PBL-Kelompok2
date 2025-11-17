<?php
use App\Helpers\Routing;
$route = new Routing();
$baseCertUrl = $route->base_url('certifications');
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen Sertifikasi</span>
    <button class="btn btn-primary" onclick="createCertification()">
        <span class="fa fa-plus"></span> Tambah
    </button>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="certifications-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Anggota</th>
                    <th>Nama Sertifikasi</th>
                    <th>Diterbitkan Oleh</th>
                    <th>Tanggal Terbit</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th width="120" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
let certTable;
const baseCertUrl = '<?= $baseCertUrl ?>';

$(function() {
    certTable = $('#certifications-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: `${baseCertUrl}?ajax=1`,
        columns: [
            { data: 'member_name', defaultContent: '-' },
            { data: 'title', defaultContent: '-' },
            { data: 'issuer', defaultContent: '-' },
            { data: 'issue_date', defaultContent: '-' },
            { data: 'expiration_date', defaultContent: '-' },
            { 
                data: 'action', 
                orderable: false, 
                searchable: false, 
                className: 'text-center' 
            }
        ]
    });
});

function createCertification() {
    $.get(`${baseCertUrl}/create?ajax=1`, function(response) {
        Swal.fire({
            title: 'Tambah Sertifikasi',
            html: response,
            width: 550,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary btn-md px-4 mr-1',
                cancelButton: 'btn btn-danger btn-md px-4'
            },
            preConfirm: () => {
                storeCertification();
            }
        });
    });
}

function storeCertification() {
    const form = $('#form-create-certification');
    if (!form.length) return;

    $.post(`${baseCertUrl}/store`, form.serialize())
        .done(() => {
            Swal.close();
            certTable.ajax.reload(null, false);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Sertifikasi berhasil ditambahkan.',
                timer: 1500,
                showConfirmButton: false
            });
        })
        .fail(() => {
            Swal.fire('Gagal', 'Terjadi kesalahan saat menambahkan sertifikasi.', 'error');
        });
}

function editCertification(id) {
    $.get(`${baseCertUrl}/edit/${id}?ajax=1`, function(response) {
        Swal.fire({
            title: 'Edit Sertifikasi',
            html: response,
            width: 550,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-warning btn-md mr-1 px-4 text-white',
                cancelButton: 'btn btn-danger btn-md px-4'
            },
            preConfirm: () => {
                updateCertification();
            }
        });
    });
}

function updateCertification() {
    const form = $('#form-edit-certification');
    if (!form.length) return;

    $.post(`${baseCertUrl}/update`, form.serialize())
        .done(() => {
            Swal.close();
            certTable.ajax.reload(null, false);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Sertifikasi berhasil diperbarui.',
                timer: 1500,
                showConfirmButton: false
            });
        })
        .fail(() => {
            Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui sertifikasi.', 'error');
        });
}

function deleteCertification(id) {
    swalConfirm('Hapus sertifikasi ini?', function() {
        $.get(`${baseCertUrl}/delete/${id}`)
            .done(() => {
                certTable.ajax.reload(null, false);

                Swal.fire({
                    icon: 'success',
                    title: 'Dihapus',
                    text: 'Sertifikasi telah dihapus.',
                    timer: 1300,
                    showConfirmButton: false
                });
            })
            .fail(() => {
                Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus sertifikasi.', 'error');
            });
    });
}
</script>
