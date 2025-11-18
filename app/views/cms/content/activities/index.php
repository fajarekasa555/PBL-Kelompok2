<?php
use App\Helpers\Routing;
$route = new Routing();
$baseActivitiesUrl = $route->base_url('activities');
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen Kegiatan</span>
    <button class="btn btn-primary" onclick="createActivity()">
        <span class="fa fa-plus"></span> Tambah
    </button>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="activities-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Lokasi</th>
                    <th>Tanggal</th>
                    <th width="140" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>

let activitiesTable;
const baseActivitiesUrl = '<?= $baseActivitiesUrl ?>';

$(function() {
    activitiesTable = $('#activities-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: `${baseActivitiesUrl}?ajax=1`,
        columns: [
            { data: 'title' },
            { data: 'description', defaultContent: '-' },
            { data: 'location', defaultContent: '-' },
            { data: 'date', defaultContent: '-' },
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
        acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
        maxFileSize: '3MB',
        credits: false,
    });
}

function createActivity() {
    $.get(`${baseActivitiesUrl}/create?ajax=1`, function(response) {
        Swal.fire({
            title: 'Tambah Kegiatan',
            html: response,
            width: 800,
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
            preConfirm: () => storeActivity()
        });
    });
}

function storeActivity() {
    const form = $('#form-create-activities')[0];
    if (!form) return false;

    const formData = new FormData(form);

    Swal.showLoading();

    $.ajax({
        url: `${baseActivitiesUrl}/store`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function() {
            Swal.close();
            activitiesTable.ajax.reload(null, false);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Kegiatan berhasil ditambahkan.',
                timer: 1500,
                showConfirmButton: false
            });
        },
        error: function() {
            Swal.fire('Gagal', 'Terjadi kesalahan saat menambahkan data.', 'error');
        }
    });

    return false;
}

function editActivity(id) {
    $.get(`${baseActivitiesUrl}/edit/${id}?ajax=1`, function(response) {
        Swal.fire({
            title: 'Edit Kegiatan',
            html: response,
            width: 800,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            didOpen: () => {
                const pond = initFilePond('.filepond');
                const imageUrl = $('#existing_documentation').val();
                if (imageUrl) {
                    pond.addFile(imageUrl);
                }
            },
            customClass: {
                confirmButton: 'btn btn-warning btn-md mr-1 px-4 text-white',
                cancelButton: 'btn btn-danger btn-md px-4'
            },
            preConfirm: () => updateActivity()
        });
    });
}

function updateActivity() {
    const form = $('#form-edit-activities')[0];
    if (!form) return;

    const formData = new FormData(form);

    Swal.showLoading();

    $.ajax({
        url: `${baseActivitiesUrl}/update`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function() {
            Swal.close();
            activitiesTable.ajax.reload(null, false);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Kegiatan berhasil diperbarui.',
                timer: 1500,
                showConfirmButton: false
            });
        },
        error: function() {
            Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui data.', 'error');
        }
    });
}

function deleteActivity(id) {
    swalConfirm('Hapus kegiatan ini?', function() {
        $.get(`${baseActivitiesUrl}/delete/${id}`)
            .done(() => {
                activitiesTable.ajax.reload(null, false);
                Swal.fire({
                    icon: 'success',
                    title: 'Dihapus',
                    text: 'Data kegiatan telah dihapus.',
                    timer: 1300,
                    showConfirmButton: false
                });
            })
            .fail(() => {
                Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data.', 'error');
            });
    });
}

function showActivity(id) {
    $.get(`${baseActivitiesUrl}/show/${id}?ajax=1`, function(response) {
        Swal.fire({
            html: response,
            width: 800,
            showCloseButton: true,
            showConfirmButton: false
        });
    }).fail(() => {
        Swal.fire('Gagal', 'Data kegiatan tidak ditemukan.', 'error');
    });
}

</script>
