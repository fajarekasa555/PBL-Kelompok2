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
    $.post(`${baseUserUrl}/store`, $('#form-create-user').serialize(), function() {
        Swal.close();
        userTable.ajax.reload(null, false);

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'User berhasil ditambahkan.',
            timer: 1500,
            showConfirmButton: false
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
    $.post(`${baseUserUrl}/update`, $('#form-edit-user').serialize(), function() {
        Swal.close();
        userTable.ajax.reload(null, false);

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'User berhasil diperbarui.',
            timer: 1500,
            showConfirmButton: false
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
