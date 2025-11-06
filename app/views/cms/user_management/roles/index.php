<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen Role</span>
    <button class="btn btn-primary" onclick="createRole()"><span class="fa fa-plus bold"></span></button>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="role-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Role</th>
                    <th width="100" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
let roleTable;

$(function() {
    roleTable = $('#role-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: 'index.php?page=roles&ajax=1',
        columns: [
            { data: 'name' },
            { data: 'action', orderable: false, searchable: false, className: 'text-center' }
        ]
    });
});

function createRole() {
    $.get('index.php?page=roles&action=create', function(response){
        Swal.fire({
            title: 'Tambah Role',
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
                storeRole();
            }
        });
    });
}

function storeRole() {
    $.post('index.php?page=roles&action=store', $('#form-create-role').serialize(), function(response) {
        Swal.close();
        roleTable.ajax.reload(null, false);

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Role berhasil ditambahkan.',
            timer: 1500,
            showConfirmButton: false
        });
    });
}

function editRole(id) {
    $.get('index.php?page=roles&action=edit&id='+id, function(response) {
        Swal.fire({
            title: 'Edit Role',
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
                updateRole();
            }
        });
    });
}

function updateRole() {
    $.post('index.php?page=roles&action=update', $('#form-edit-role').serialize(), function(response) {
        Swal.close();
        roleTable.ajax.reload(null, false);

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Role berhasil diperbarui.',
            timer: 1500,
            showConfirmButton: false
        });
    });
}

function deleteRole(id) {
    swalConfirm('Hapus role ini?', function() {
        $.get('index.php?page=roles&action=delete&id=' + id, function() {
            roleTable.ajax.reload(null, false);
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
