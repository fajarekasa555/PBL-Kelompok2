<?php
use App\Helpers\Routing;
$route = new Routing();
$baseVisionUrl = $route->base_url('vision');
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen Visi Laboratorium</span>
    <button class="btn btn-primary" onclick="createVision()">
        <span class="fa fa-plus bold"></span>
    </button>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="vision-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Visi</th>
                    <th width="120" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
let visionTable;
const baseVisionUrl = '<?= $baseVisionUrl ?>';

$(function() {
    visionTable = $('#vision-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: `${baseVisionUrl}?ajax=1`,
        columns: [
            { data: 'vision' },
            { 
                data: 'action',
                orderable: false,
                searchable: false,
                className: 'text-center'
            }
        ]
    });
});

function createVision() {
    $.get(`${baseVisionUrl}/create?ajax=1`, function(response) {
        Swal.fire({
            title: 'Tambah Visi Laboratorium',
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
            preConfirm: () => storeVision()
        });
    });
}

function storeVision() {
    $.post(`${baseVisionUrl}/store`, $('#form-create-vision').serialize(), function() {
        Swal.close();
        visionTable.ajax.reload(null, false);

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Visi berhasil ditambahkan.',
            timer: 1500,
            showConfirmButton: false
        });
    });
}

function editVision(id) {
    $.get(`${baseVisionUrl}/edit/${id}?ajax=1`, function(response) {
        Swal.fire({
            title: 'Edit Visi Laboratorium',
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
            preConfirm: () => updateVision()
        });
    });
}

function updateVision() {
    $.post(`${baseVisionUrl}/update`, $('#form-edit-vision').serialize(), function() {
        Swal.close();
        visionTable.ajax.reload(null, false);

        Swal.fire({
            icon: 'success',
            title: 'Diperbarui',
            text: 'Visi berhasil diperbarui.',
            timer: 1500,
            showConfirmButton: false
        });
    });
}

function deleteVision(id) {
    swalConfirm('Hapus visi ini?', function() {
        $.get(`${baseVisionUrl}/delete/${id}`, function() {
            visionTable.ajax.reload(null, false);

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
