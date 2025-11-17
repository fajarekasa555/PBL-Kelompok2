<?php
use App\Helpers\Routing;
$route = new Routing();
$baseExpertiesUrl = $route->base_url('experties');
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen Keahlian</span>
    <button class="btn btn-primary" onclick="createExperties()">
        <span class="fa fa-plus"></span> Tambah
    </button>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="experties-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Keahlian</th>
                    <th width="120" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
let expertiesTable;
const baseExpertiesUrl = '<?= $baseExpertiesUrl ?>';

$(function() {
    expertiesTable = $('#experties-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: `${baseExpertiesUrl}?ajax=1`,
        columns: [
            { data: 'name', defaultContent: '-' },
            { 
                data: 'action', 
                orderable: false, 
                searchable: false, 
                className: 'text-center'
            }
        ]
    });
});

function createExperties() {
    $.get(`${baseExpertiesUrl}/create?ajax=1`, function(response) {
        Swal.fire({
            title: 'Tambah Keahlian',
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
                storeExperties();
            }
        });
    });
}

function storeExperties() {
    const form = $('#form-create-experties');
    if (!form.length) return;

    $.post(`${baseExpertiesUrl}/store`, form.serialize())
        .done(() => {
            Swal.close();
            expertiesTable.ajax.reload(null, false);
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Keahlian berhasil ditambahkan.',
                timer: 1500,
                showConfirmButton: false
            });
        });
}

function editExperties(id) {
    $.get(`${baseExpertiesUrl}/edit/${id}?ajax=1`, function(response) {
        Swal.fire({
            title: 'Edit Keahlian',
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
                updateExperties();
            }
        });
    });
}

function updateExperties() {
    const form = $('#form-edit-experties');
    if (!form.length) return;

    $.post(`${baseExpertiesUrl}/update`, form.serialize())
        .done(() => {
            Swal.close();
            expertiesTable.ajax.reload(null, false);
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Keahlian berhasil diperbarui.',
                timer: 1500,
                showConfirmButton: false
            });
        });
}

function deleteExperties(id) {
    swalConfirm('Hapus keahlian ini?', function() {
        $.get(`${baseExpertiesUrl}/delete/${id}`)
            .done(() => {
                expertiesTable.ajax.reload(null, false);
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
