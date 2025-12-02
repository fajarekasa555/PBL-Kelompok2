<?php
use App\Helpers\Routing;
$route = new Routing();
$baseUserUrl = $route->base_url('users');
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen User</span>
    <button class="btn btn-primary" onclick="createUser()">
        <span class="fa fa-plus bold"></span>
    </button>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="user-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th width="120" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
let userTable;
const baseUserUrl = '<?= $baseUserUrl ?>';

$(function() {
    userTable = $('#user-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: `${baseUserUrl}?ajax=1`, // contoh: /user?ajax=1
        columns: [
            { data: 'username' },
            { data: 'role_name' },
            { data: 'action', orderable: false, searchable: false, className: 'text-center' }
        ]
    });
});

function createUser() {
    $.get(`${baseUserUrl}/create?ajax=1`, function(response) {
        Swal.fire({
            title: 'Tambah User',
            html: response,
            width: 500,
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
                storeUser();
            }
        });
    });
}

function storeUser() {
    const form = $('#form-create-user');
    if (!form.length) return;

    $.post(`${baseUserUrl}/store`, form.serialize())
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
            userTable.ajax.reload(null, false);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'User berhasil ditambahkan.',
                timer: 1500,
                showConfirmButton: false
            });
        })
        .fail(() => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan server.'
            });
        });
}

function editUser(id) {
    $.get(`${baseUserUrl}/edit/${id}?ajax=1`, function(response) {
        Swal.fire({
            title: 'Edit User',
            html: response,
            width: 500,
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
                updateUser();
            }
        });
    });
}

function updateUser() {
    const form = $('#form-edit-user');
    if (!form.length) return;

    $.post(`${baseUserUrl}/update`, form.serialize())
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
            userTable.ajax.reload(null, false);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'User berhasil diperbarui.',
                timer: 1500,
                showConfirmButton: false
            });
        })
        .fail(() => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan server.'
            });
        });
}

function deleteUser(id) {
    swalConfirm('Hapus user ini?', function() {
        $.get(`${baseUserUrl}/delete/${id}`, function() {
            userTable.ajax.reload(null, false);
            Swal.fire({
                icon: 'success',
                title: 'Dihapus',
                timer: 1300,
                showConfirmButton: false
            });
        });
    });
}
</script>
