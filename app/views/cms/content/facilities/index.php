<?php
use App\Helpers\Routing;
$route = new Routing();
$baseFacilitiesUrl = $route->base_url('facilities');
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen Fasilitas</span>
    <button class="btn btn-primary" onclick="createFacility()">
        <span class="fa fa-plus"></span> Tambah
    </button>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="facilities-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Slug</th>
                    <th>Deskripsi</th>
                    <th width="140" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>

let facilitiesTable;
const baseFacilitiesUrl = '<?= $baseFacilitiesUrl ?>';

$(function() {
    facilitiesTable = $('#facilities-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: `${baseFacilitiesUrl}?ajax=1`,
        columns: [
            { data: 'slug' },
            { data: 'description', defaultContent: '-' },
            { 
                data: 'action',
                orderable: false,
                searchable: false,
                className: 'text-center'
            }
        ]
    });
});

function initFilePond(selector) {
    return FilePond.create(document.querySelector(selector), {
        storeAsFile: true,
        allowMultiple: false,
        instantUpload: false,
        labelIdle: 'Drag & Drop file atau <span class="filepond--label-action">Browse</span>',
        acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'],
        maxFileSize: '3MB',
        credits: false,
    });
}

function createFacility() {
    $.get(`${baseFacilitiesUrl}/create?ajax=1`, function(response) {
        Swal.fire({
            title: 'Tambah Fasilitas',
            html: response,
            width: 700,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            didOpen: () => {
                initFilePond('.filepond');
            },
            customClass: {
                confirmButton: 'btn btn-primary btn-md px-4 mr-1',
                cancelButton: 'btn btn-danger btn-md px-4'
            },
            preConfirm: () => storeFacility()
        });
    });
}

function storeFacility() {
    const form = $('#form-create-facility')[0];
    if (!form) return false;

    const formData = new FormData(form);
    Swal.showLoading();

    $.ajax({
        url: `${baseFacilitiesUrl}/store`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            Swal.close();

            if (typeof response === 'string') {
                try {
                    response = JSON.parse(response);
                } catch (e) {
                    response = { status: 'error', message: response };
                }
            }

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
                            <ul style="list-style:none; padding-left:0; margin:0;">
                                ${errorText || response.message}
                            </ul>
                        </div>
                    `
                });
                return;
            }

            facilitiesTable.ajax.reload(null, false);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Fasilitas berhasil ditambahkan.',
                timer: 1500,
                showConfirmButton: false
            });
        },
        error: function() {
            Swal.fire('Gagal', 'Terjadi kesalahan server.', 'error');
        }
    });

    return false;
}

function editFacility(id) {
    $.get(`${baseFacilitiesUrl}/edit/${id}?ajax=1`, function(response) {
        Swal.fire({
            title: 'Edit Fasilitas',
            html: response,
            width: 700,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            didOpen: () => {
                const pond = initFilePond('.filepond');
                const imageUrl = $('#existing_image').val();
                if (imageUrl) {
                    pond.addFile(imageUrl);
                }
            },
            customClass: {
                confirmButton: 'btn btn-warning btn-md mr-1 px-4 text-white',
                cancelButton: 'btn btn-danger btn-md px-4'
            },
            preConfirm: () => updateFacility()
        });
    });
}

function updateFacility() {
    const form = $('#form-edit-facility')[0];
    if (!form) return false;

    const formData = new FormData(form);
    Swal.showLoading();

    $.ajax({
        url: `${baseFacilitiesUrl}/update`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            Swal.close();
            try {
                const res = typeof response === 'object' ? response : JSON.parse(response);

                if (res.status === 'error') {
                    let errorText = '';
                    if (res.errors) {
                        Object.values(res.errors).forEach(err => {
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
                                <ul style="list-style:none; padding-left:0; margin:0;">
                                    ${errorText || res.message}
                                </ul>
                            </div>
                        `
                    });
                    return;
                }

                facilitiesTable.ajax.reload(null, false);
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: res.message || 'Fasilitas berhasil diperbarui.',
                    timer: 1500,
                    showConfirmButton: false
                });
            } catch (e) {
                Swal.fire('Gagal', 'Response server tidak valid.', 'error');
            }
        },
        error: function() {
            Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui data.', 'error');
        }
    });

    return false;
}

function deleteFacility(id) {
    swalConfirm('Hapus fasilitas ini?', function() {
        $.get(`${baseFacilitiesUrl}/delete/${id}`)
            .done(() => {
                facilitiesTable.ajax.reload(null, false);
                Swal.fire({
                    icon: 'success',
                    title: 'Dihapus',
                    text: 'Data fasilitas telah dihapus.',
                    timer: 1300,
                    showConfirmButton: false
                });
            })
            .fail(() => {
                Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data.', 'error');
            });
    });
}

function showFacility(id) {
    $.get(`${baseFacilitiesUrl}/show/${id}?ajax=1`, function(response) {
        Swal.fire({
            html: response,
            width: 700,
            showCloseButton: true,
            showConfirmButton: false
        });
    }).fail(() => {
        Swal.fire('Gagal', 'Data fasilitas tidak ditemukan.', 'error');
    });
}

</script>
