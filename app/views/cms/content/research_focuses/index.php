<?php
use App\Helpers\Routing;
$route = new Routing();
$baseFocusUrl = $route->base_url('research-focuses');
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen Research Focus</span>
    <button class="btn btn-primary" onclick="createFocus()">
        <span class="fa fa-plus bold"></span>
    </button>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="focus-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Bidang</th>
                    <th>Deskripsi</th>
                    <th width="120" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
let focusTable;
const baseFocusUrl = '<?= $baseFocusUrl ?>';

$(function() {
    focusTable = $('#focus-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: `${baseFocusUrl}?ajax=1`,
        columns: [
            { data: 'title' },
            { data: 'field' },
            { data: 'description' },
            { 
                data: 'action', 
                orderable: false, 
                searchable: false, 
                className: 'text-center' 
            }
        ]
    });
});

function createFocus() {
    $.get(`${baseFocusUrl}/create?ajax=1`, function(response) {
        Swal.fire({
            title: 'Tambah Research Focus',
            html: response,
            width: 650,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary btn-md px-4 mr-1',
                cancelButton: 'btn btn-danger btn-md px-4'
            },
            preConfirm: () => storeFocus()
        });
    });
}

function storeFocus() {
    $.post(`${baseFocusUrl}/store`, $('#form-create-focus').serialize(), function() {
        Swal.close();
        focusTable.ajax.reload(null, false);

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Research focus berhasil ditambahkan.',
            timer: 1500,
            showConfirmButton: false
        });
    });
}

function editFocus(id) {
    $.get(`${baseFocusUrl}/edit/${id}?ajax=1`, function(response) {
        Swal.fire({
            title: 'Edit Research Focus',
            html: response,
            width: 650,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-warning btn-md mr-1 px-4 text-white',
                cancelButton: 'btn btn-danger btn-md px-4'
            },
            preConfirm: () => updateFocus()
        });
    });
}

function updateFocus() {
    $.post(`${baseFocusUrl}/update`, $('#form-edit-focus').serialize(), function() {
        Swal.close();
        focusTable.ajax.reload(null, false);

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Research focus berhasil diperbarui.',
            timer: 1500,
            showConfirmButton: false
        });
    });
}

function deleteFocus(id) {
    swalConfirm('Hapus research focus ini?', function() {
        $.get(`${baseFocusUrl}/delete/${id}`, function() {
            focusTable.ajax.reload(null, false);

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
