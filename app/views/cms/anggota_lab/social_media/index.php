<?php
use App\Helpers\Routing;
$route = new Routing();
$baseSocialMediaUrl = $route->base_url('social_media'); 
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen Media Sosial</span>
    <button class="btn btn-primary" onclick="createSocialMedia()">
        <span class="fa fa-plus"></span> Tambah
    </button>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="social-media-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width=2 >Icon</th>
                    <th>Platform</th>
                    <th>Anggota</th>
                    <th width="120" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
let socialMediaTable;
const baseSocialMediaUrl = '<?= $baseSocialMediaUrl ?>';

$(function() {
    socialMediaTable = $('#social-media-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: `${baseSocialMediaUrl}?ajax=1`,
        columns: [
            { data: 'icon', orderable: false, searchable: false, className: 'text-center' },
            { data: 'platform' },
            { data: 'member_name', defaultContent: '-' },
            { 
                data: 'action', 
                orderable: false, 
                searchable: false, 
                className: 'text-center' 
            }
        ],
        language: {
            emptyTable: "Belum ada data media sosial",
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data"
        }
    });
});

function createSocialMedia() {
    $.get(`${baseSocialMediaUrl}/create?ajax=1`, function(response) {
        Swal.fire({
            title: 'Tambah Media Sosial',
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
                storeSocialMedia();
            }
        });
    });
}

function storeSocialMedia() {
    const form = $('#form-create-social_media');
    if (!form.length) return;

    $.post(`${baseSocialMediaUrl}/store`, form.serialize())
        .done(() => {
            Swal.close();
            socialMediaTable.ajax.reload(null, false);
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Media sosial berhasil ditambahkan.',
                timer: 1500,
                showConfirmButton: false
            });
        })
        .fail(() => {
            Swal.fire('Gagal', 'Terjadi kesalahan saat menambahkan data.', 'error');
        });
}

function editSocialMedia(id) {
    $.get(`${baseSocialMediaUrl}/edit/${id}?ajax=1`, function(response) {
        Swal.fire({
            title: 'Edit Media Sosial',
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
                updateSocialMedia();
            }
        });
    });
}

function updateSocialMedia() {
    const form = $('#form-edit-social_media');
    if (!form.length) return;

    $.post(`${baseSocialMediaUrl}/update`, form.serialize())
        .done(() => {
            Swal.close();
            socialMediaTable.ajax.reload(null, false);
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Media sosial berhasil diperbarui.',
                timer: 1500,
                showConfirmButton: false
            });
        })
        .fail(() => {
            Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui data.', 'error');
        });
}

function deleteSocialMedia(id) {
    swalConfirm('Hapus media sosial ini?', function() {
        $.get(`${baseSocialMediaUrl}/delete/${id}`)
            .done(() => {
                socialMediaTable.ajax.reload(null, false);
                Swal.fire({
                    icon: 'success',
                    title: 'Dihapus',
                    text: 'Media sosial telah dihapus.',
                    timer: 1300,
                    showConfirmButton: false
                });
            })
            .fail(() => {
                Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data.', 'error');
            });
    });
}

function showSocialmedia(url) {
    if (url && url.startsWith('http')) {
        window.open(url, '_blank');
    } else {
        Swal.fire('Tidak valid', 'Link media sosial tidak valid.', 'warning');
    }
}
</script>
