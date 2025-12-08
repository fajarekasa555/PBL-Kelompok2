<?php
use App\Helpers\Routing;
$route = new Routing();
$basePublicationsUrl = $route->base_url('publications');
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen Publikasi</span>
    <button class="btn btn-primary" onclick="createPublications()">
        <span class="fa fa-plus"></span> Tambah
    </button>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="publications-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th width="2">Tipe</th>
                    <th>Tanggal</th>
                    <th>Anggota</th>
                    <th width="120" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
let publicationsTable;
const basePublicationsUrl = '<?= $basePublicationsUrl ?>';

$(function() {
    publicationsTable = $('#publications-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: `${basePublicationsUrl}?ajax=1`,
        columns: [
            { data: 'title' },
            { data: 'type', orderable: false, searchable: false, className: 'text-center' },
            { data: 'date' },
            { data: 'member_name', defaultContent: '-' },
            { 
                data: 'action', 
                orderable: false, 
                searchable: false, 
                className: 'text-center' 
            }
        ]
    });
});

function createPublications() {
    $.get(`${basePublicationsUrl}/create?ajax=1`, function(response) {
        Swal.fire({
            title: 'Tambah Publikasi',
            html: response,
            width: 550,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            didOpen: () => {
                $('.select2').select2({
                    dropdownParent: $('.swal2-container'),
                    width: '100%'
                });
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    todayHighlight: true
                });
            },
            customClass: {
                confirmButton: 'btn btn-primary btn-md px-4 mr-1',
                cancelButton: 'btn btn-danger btn-md px-4'
            },
            preConfirm: () => {
                storePublications();
            }
        });
    });
}

function storePublications() {
    const form = $('#form-create-publications');
    if (!form.length) return;

    $.post(`${basePublicationsUrl}/store`, form.serialize())
        .done((response) => {
            if (response.status === 'error') {
                let errorText = '';

                if (response.errors) {
                    Object.values(response.errors).forEach(err => {
                        errorText += `<li>${err}</li>`;
                    });
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: `
                        <div style="
                            text-align:center;
                            margin-top:15px;
                            padding:10px 15px;
                            border-radius:8px;
                            background:#f8d7da;
                            color:#842029;
                            font-size:14px;
                            line-height:1.6;
                        ">
                            <ul style="
                                list-style:none;
                                padding-left:0;
                                margin:0;
                            ">
                                ${errorText}
                            </ul>
                        </div>
                    `
                });

                return;
            }

            Swal.close();
            publicationsTable.ajax.reload(null, false);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Publikasi berhasil ditambahkan.',
                timer: 1500,
                showConfirmButton: false
            });
        })
        .fail(() => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan pada server.'
            });
        });
}


function editPublications(id) {
    $.get(`${basePublicationsUrl}/edit/${id}?ajax=1`, function(response) {
        Swal.fire({
            title: 'Edit Publikasi',
            html: response,
            width: 550,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            didOpen: () => {
                $('.select2').select2({
                    dropdownParent: $('.swal2-container'),
                    width: '100%'
                });
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    todayHighlight: true
                });
            },
            customClass: {
                confirmButton: 'btn btn-warning btn-md mr-1 px-4 text-white',
                cancelButton: 'btn btn-danger btn-md px-4'
            },
            preConfirm: () => {
                updatePublications();
            }
        });
    });
}

function updatePublications() {
    const form = $('#form-edit-publications');
    if (!form.length) return;

    $.post(`${basePublicationsUrl}/update`, form.serialize())
        .done((response) => {

            if (response.status === 'error') {
                let errorText = '';

                if (response.errors) {
                    Object.values(response.errors).forEach(err => {
                        errorText += `<li>${err}</li>`;
                    });
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: `
                        <div style="
                            text-align:center;
                            margin-top:15px;
                            padding:10px 15px;
                            border-radius:8px;
                            background:#f8d7da;
                            color:#842029;
                            font-size:14px;
                            line-height:1.6;
                        ">
                            <ul style="
                                list-style:none;
                                padding-left:0;
                                margin:0;
                            ">
                                ${errorText}
                            </ul>
                        </div>
                    `
                });

                return;
            }

            Swal.close();
            publicationsTable.ajax.reload(null, false);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Publikasi berhasil diperbarui.',
                timer: 1500,
                showConfirmButton: false
            });
        })
        .fail(() => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan pada server.'
            });
        });
}


function deletePublications(id) {
    swalConfirm('Hapus publikasi ini?', function() {
        $.get(`${basePublicationsUrl}/delete/${id}`)
            .done(() => {
                publicationsTable.ajax.reload(null, false);
                Swal.fire({
                    icon: 'success',
                    title: 'Dihapus',
                    text: 'Publikasi telah dihapus.',
                    timer: 1300,
                    showConfirmButton: false
                });
            })
            .fail(() => {
                Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data.', 'error');
            });
    });
}

function showPublications(url) {
    if (url && url.startsWith('http')) {
        window.open(url, '_blank');
    } else {
        Swal.fire('Tidak valid', 'Link publikasi tidak ditemukan atau tidak valid.', 'warning');
    }
}
</script>
