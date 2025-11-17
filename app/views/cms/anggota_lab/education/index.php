<?php
use App\Helpers\Routing;
$route = new Routing();
$baseEducationsUrl = $route->base_url('educations');
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen Pendidikan</span>
    <button class="btn btn-primary" onclick="createEducation()">
        <span class="fa fa-plus"></span> Tambah
    </button>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="educations-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Anggota</th>
                    <th>Gelar</th>
                    <th>Jurusan</th>
                    <th>Institusi</th>
                    <th>Periode</th>
                    <th width="120" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
let educationsTable;
const baseEducationsUrl = '<?= $baseEducationsUrl ?>';

$(function() {
    educationsTable = $('#educations-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: `${baseEducationsUrl}?ajax=1`,
        columns: [
            { data: 'member_name', defaultContent: '-' },
            { data: 'degree', defaultContent: '-' },
            { data: 'major', defaultContent: '-' },
            { data: 'institution', defaultContent: '-' },
            { data: 'periode', defaultContent: '-' },
            { 
                data: 'action', 
                orderable: false, 
                searchable: false, 
                className: 'text-center' 
            }
        ]
    });
});

function createEducation() {
    $.get(`${baseEducationsUrl}/create?ajax=1`, function(response) {
        Swal.fire({
            title: 'Tambah Pendidikan',
            html: response,
            width: 550,
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
                storeEducation();
            }
        });
    });
}

function storeEducation() {
    const form = $('#form-create-education');
    if (!form.length) return;

    $.post(`${baseEducationsUrl}/store`, form.serialize())
        .done(() => {
            Swal.close();
            educationsTable.ajax.reload(null, false);
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data pendidikan berhasil ditambahkan.',
                timer: 1500,
                showConfirmButton: false
            });
        })
        .fail(() => {
            Swal.fire('Gagal', 'Terjadi kesalahan saat menambahkan data.', 'error');
        });
}

function editEducation(id) {
    $.get(`${baseEducationsUrl}/edit/${id}?ajax=1`, function(response) {
        Swal.fire({
            title: 'Edit Pendidikan',
            html: response,
            width: 550,
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
                updateEducation();
            }
        });
    });
}

function updateEducation() {
    const form = $('#form-edit-education');
    if (!form.length) return;

    $.post(`${baseEducationsUrl}/update`, form.serialize())
        .done(() => {
            Swal.close();
            educationsTable.ajax.reload(null, false);
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data pendidikan berhasil diperbarui.',
                timer: 1500,
                showConfirmButton: false
            });
        })
        .fail(() => {
            Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui data.', 'error');
        });
}

function deleteEducation(id) {
    swalConfirm('Hapus data pendidikan ini?', function() {
        $.get(`${baseEducationsUrl}/delete/${id}`)
            .done(() => {
                educationsTable.ajax.reload(null, false);
                Swal.fire({
                    icon: 'success',
                    title: 'Dihapus',
                    text: 'Data pendidikan telah dihapus.',
                    timer: 1300,
                    showConfirmButton: false
                });
            })
            .fail(() => {
                Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data.', 'error');
            });
    });
}
</script>
