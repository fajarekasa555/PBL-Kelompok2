<?php
use App\Helpers\Routing;
$route = new Routing();
$baseCourseUrl = $route->base_url('courses');
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen Mata Kuliah</span>
    <button class="btn btn-primary" onclick="createCourse()">
        <span class="fa fa-plus"></span> Tambah
    </button>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="courses-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Anggota</th>
                    <th>Semester</th>
                    <th>Nama Mata Kuliah</th>
                    <th width="120" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
let courseTable;
const baseCourseUrl = '<?= $baseCourseUrl ?>';

$(function() {
    courseTable = $('#courses-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: `${baseCourseUrl}?ajax=1`,
        columns: [
            { data: 'member_name', defaultContent: '-' },
            { data: 'semester', defaultContent: '-' },
            { data: 'course_name', defaultContent: '-' },
            { 
                data: 'action', 
                orderable: false, 
                searchable: false, 
                className: 'text-center' 
            }
        ]
    });
});

function createCourse() {
    $.get(`${baseCourseUrl}/create?ajax=1`, function(response) {
        Swal.fire({
            title: 'Tambah Mata Kuliah',
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
                storeCourse();
            }
        });
    });
}

function storeCourse() {
    const form = $('#form-create-course');
    if (!form.length) return;

    $.post(`${baseCourseUrl}/store`, form.serialize())
        .done(() => {
            Swal.close();
            courseTable.ajax.reload(null, false);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Mata kuliah berhasil ditambahkan.',
                timer: 1400,
                showConfirmButton: false
            });
        })
        .fail(() => {
            Swal.fire('Gagal', 'Terjadi kesalahan saat menambahkan mata kuliah.', 'error');
        });
}

function editCourse(id) {
    $.get(`${baseCourseUrl}/edit/${id}?ajax=1`, function(response) {
        Swal.fire({
            title: 'Edit Mata Kuliah',
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
                updateCourse();
            }
        });
    });
}

function updateCourse() {
    const form = $('#form-edit-course');
    if (!form.length) return;

    $.post(`${baseCourseUrl}/update`, form.serialize())
        .done(() => {
            Swal.close();
            courseTable.ajax.reload(null, false);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Mata kuliah berhasil diperbarui.',
                timer: 1400,
                showConfirmButton: false
            });
        })
        .fail(() => {
            Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui mata kuliah.', 'error');
        });
}

function deleteCourse(id) {
    swalConfirm('Hapus mata kuliah ini?', function() {
        $.get(`${baseCourseUrl}/delete/${id}`)
            .done(() => {
                courseTable.ajax.reload(null, false);

                Swal.fire({
                    icon: 'success',
                    title: 'Dihapus',
                    text: 'Mata kuliah telah dihapus.',
                    timer: 1300,
                    showConfirmButton: false
                });
            })
            .fail(() => {
                Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus mata kuliah.', 'error');
            });
    });
}
</script>
