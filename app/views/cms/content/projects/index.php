<?php
use App\Helpers\Routing;
$route = new Routing();
$baseProjectsUrl = $route->base_url('projects');
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen Project</span>
    <button class="btn btn-primary" onclick="createProject()">
        <span class="fa fa-plus"></span> Tambah
    </button>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="projects-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Project</th>
                    <th>Deskripsi</th>
                    <th width="140" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>

let projectsTable;
const baseProjectsUrl = '<?= $baseProjectsUrl ?>';

$(function() {
    projectsTable = $('#projects-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: `${baseProjectsUrl}?ajax=1`,
        columns: [
            { data: 'name' },
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
        acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
        maxFileSize: '3MB',
        credits: false,
    });
}

function createProject() {
    $.get(`${baseProjectsUrl}/create?ajax=1`, function(response) {
        Swal.fire({
            title: 'Tambah Project',
            html: response,
            width: 800,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            didOpen: () => {
                $('.multiple-select2').select2({
                    width: '100%',
                    dropdownParent: $('.swal2-popup')
                }).trigger('change');

                initFilePond('.filepond');
            },
            customClass: {
                confirmButton: 'btn btn-primary btn-md px-4 mr-1',
                cancelButton: 'btn btn-danger btn-md px-4'
            },
            preConfirm: () => storeProject()
        });
    });
}

function storeProject() {
    const form = $('#form-create-project')[0];
    if (!form) return false;

    const formData = new FormData(form);

    Swal.showLoading();

    $.ajax({
        url: `${baseProjectsUrl}/store`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function() {
            Swal.close();
            projectsTable.ajax.reload(null, false);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Project berhasil ditambahkan.',
                timer: 1500,
                showConfirmButton: false
            });
        },
        error: function() {
            Swal.fire('Gagal', 'Terjadi kesalahan saat menambahkan project.', 'error');
        }
    });

    return false;
}

function editProject(id) {
    $.get(`${baseProjectsUrl}/edit/${id}?ajax=1`, function(response) {
        Swal.fire({
            title: 'Edit Project',
            html: response,
            width: 800,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            didOpen: () => {
                $('.multiple-select2').select2({
                    width: '100%',
                    dropdownParent: $('.swal2-popup')
                }).trigger('change');

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
            preConfirm: () => updateProject()
        });
    });
}

function updateProject() {
    const form = $('#form-edit-project')[0];
    if (!form) return;

    const formData = new FormData(form);

    Swal.showLoading();

    $.ajax({
        url: `${baseProjectsUrl}/update`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function() {
            Swal.close();
            projectsTable.ajax.reload(null, false);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Project berhasil diperbarui.',
                timer: 1500,
                showConfirmButton: false
            });
        },
        error: function() {
            Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui project.', 'error');
        }
    });
}

function deleteProject(id) {
    swalConfirm('Hapus project ini?', function() {
        $.get(`${baseProjectsUrl}/delete/${id}`)
            .done(() => {
                projectsTable.ajax.reload(null, false);
                Swal.fire({
                    icon: 'success',
                    title: 'Dihapus',
                    text: 'Project telah dihapus.',
                    timer: 1300,
                    showConfirmButton: false
                });
            })
            .fail(() => {
                Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus project.', 'error');
            });
    });
}

function showProject(id) {
    $.get(`${baseProjectsUrl}/show/${id}?ajax=1`, function(response) {
        Swal.fire({
            html: response,
            width: 800,
            showCloseButton: true,
            showConfirmButton: false
        });
    }).fail(() => {
        Swal.fire('Gagal', 'Data project tidak ditemukan.', 'error');
    });
}

</script>
