<?php
use App\Helpers\Routing;
$route = new Routing();
$baseMissionUrl = $route->base_url('mission');
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen Misi Laboratorium</span>
    <button class="btn btn-primary" onclick="createMission()">
        <span class="fa fa-plus bold"></span>
    </button>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="mission-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="5">Urutan</th>
                    <th>Misi</th>
                    <!-- <th>Status</th> -->
                    <th width="120" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
let missionTable;
const baseMissionUrl = '<?= $baseMissionUrl ?>';

$(function() {
    missionTable = $('#mission-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: `${baseMissionUrl}?ajax=1`,
        columns: [
            { data: 'order_number' },
            { data: 'mission' },
            // { data: 'is_active' },
            { 
                data: 'action',
                orderable: false,
                searchable: false,
                className: 'text-center'
            }
        ]
    });
});

function createMission() {
    $.get(`${baseMissionUrl}/create?ajax=1`, function(response) {
        Swal.fire({
            title: 'Tambah Misi Laboratorium',
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
            preConfirm: () => storeMission()
        });
    });
}

function storeMission() {
    $.post(`${baseMissionUrl}/store`, $('#form-create-mission').serialize(), function() {
        Swal.close();
        missionTable.ajax.reload(null, false);

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Misi berhasil ditambahkan.',
            timer: 1500,
            showConfirmButton: false
        });
    });
}

function editMission(id) {
    $.get(`${baseMissionUrl}/edit/${id}?ajax=1`, function(response) {
        Swal.fire({
            title: 'Edit Misi Laboratorium',
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
            preConfirm: () => updateMission()
        });
    });
}

function updateMission() {
    $.post(`${baseMissionUrl}/update`, $('#form-edit-mission').serialize(), function() {
        Swal.close();
        missionTable.ajax.reload(null, false);

        Swal.fire({
            icon: 'success',
            title: 'Diperbarui',
            text: 'Misi berhasil diperbarui.',
            timer: 1500,
            showConfirmButton: false
        });
    });
}

function deleteMission(id) {
    swalConfirm('Hapus misi ini?', function() {
        $.get(`${baseMissionUrl}/delete/${id}`, function() {
            missionTable.ajax.reload(null, false);

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
