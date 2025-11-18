<?php
use App\Helpers\Routing;
$route = new Routing();
$baseMembersUrl = $route->base_url('members');
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen Anggota</span>
    <button class="btn btn-primary" onclick="createMember()">
        <span class="fa fa-plus"></span> Tambah
    </button>
</h1>

<div class="row g-4 mb-4">

    <!-- Total Anggota -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card card-primary">
            <div class="gradient-overlay"></div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Total Anggota</div>
                        <h3 class="stat-value"><?= $stats['total_members'] ?? 0 ?></h3>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jabatan Terdaftar -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card card-success">
            <div class="gradient-overlay"></div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Jabatan Terdaftar</div>
                        <h3 class="stat-value"><?= $stats['total_jabatan'] ?? 0 ?></h3>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Email Terisi -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card card-danger">
            <div class="gradient-overlay"></div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Email Terisi</div>
                        <h3 class="stat-value"><?= $stats['filled_email'] ?? 0 ?></h3>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Telepon Terisi -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card card-warning">
            <div class="gradient-overlay"></div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Telepon Terisi</div>
                        <h3 class="stat-value"><?= $stats['filled_phone'] ?? 0 ?></h3>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="members-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th width="140" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>

let membersTable;
const baseMembersUrl = '<?= $baseMembersUrl ?>';

$(function() {
    $('.select2').select2({
        width: '100%',
        placeholder: "Pilih bidang keahlian",
        allowClear: true
    });
    membersTable = $('#members-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: `${baseMembersUrl}?ajax=1`,
        columns: [
            { data: 'name' },
            { data: 'jabatan', defaultContent: '-' },
            { data: 'email', defaultContent: '-' },
            { data: 'phone', defaultContent: '-' },
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

        labelIdle: 'Drag & Drop foto atau <span class="filepond--label-action">Browse</span>',
        acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
        maxFileSize: '2MB',
        credits: false,
    });
}

function createMember() {
    $.get(`${baseMembersUrl}/create?ajax=1`, function(response) {
        Swal.fire({
            title: 'Tambah Anggota',
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
            preConfirm: () => storeMembers()
        });
    });
}

function storeMembers() {
    const form = $('#form-create-members')[0];
    if (!form) return false;

    const formData = new FormData(form);
    
    Swal.showLoading();

    $.ajax({
        url: `${baseMembersUrl}/store`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            Swal.close();
            membersTable.ajax.reload(null, false);
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Anggota berhasil ditambahkan.',
                timer: 1500,
                showConfirmButton: false
            });
        },
        error: function(xhr) {
            Swal.fire('Gagal', 'Terjadi kesalahan saat menambahkan data.', 'error');
        }
    });

    return false;
}


function editMember(id) {
    $.get(`${baseMembersUrl}/edit/${id}?ajax=1`, function(response) {
        Swal.fire({
            title: 'Edit Anggota',
            html: response,
            width: 800,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            didOpen: () => {
                $('.multiple-select2').select2({
                    placeholder: "Pilih bidang keahlian",
                    width: '100%',
                    dropdownParent: $('.swal2-popup')
                }).trigger('change');

                const pond = initFilePond('.filepond');

                const imageUrl = $('#existing_photo').val();
                if (imageUrl) {
                    pond.addFile(imageUrl);
                }
            },
            customClass: {
                confirmButton: 'btn btn-warning btn-md mr-1 px-4 text-white',
                cancelButton: 'btn btn-danger btn-md px-4'
            },
            preConfirm: () => updateMembers()
        });
    });
}

function updateMembers() {
    const form = $('#form-edit-members')[0];
    if (!form) return;

    const formData = new FormData(form);

    Swal.showLoading();

    $.ajax({
        url: `${baseMembersUrl}/update`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function() {
            Swal.close();
            membersTable.ajax.reload(null, false);
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Anggota berhasil diperbarui.',
                timer: 1500,
                showConfirmButton: false
            });
        },
        error: function() {
            Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui data.', 'error');
        }
    });
}


function deleteMember(id) {
    swalConfirm('Hapus anggota ini?', function() {
        $.get(`${baseMembersUrl}/delete/${id}`)
            .done(() => {
                membersTable.ajax.reload(null, false);
                Swal.fire({
                    icon: 'success',
                    title: 'Dihapus',
                    text: 'Data anggota telah dihapus.',
                    timer: 1300,
                    showConfirmButton: false
                });
            })
            .fail(() => {
                Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data.', 'error');
            });
    });
}

function showMember(id) {
    $.get(`${baseMembersUrl}/show/${id}?ajax=1`, function(response) {
        Swal.fire({
            html: response,
            width: 800,
            showCloseButton: true,
            showConfirmButton: false
        });
    }).fail(() => {
        Swal.fire('Gagal', 'Data anggota tidak ditemukan.', 'error');
    });
}
</script>
