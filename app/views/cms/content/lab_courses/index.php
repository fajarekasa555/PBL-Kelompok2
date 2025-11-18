<?php
use App\Helpers\Routing;
$route = new Routing();
$baseCourseUrl = $route->base_url('lab-courses');
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen Lab Course</span>
    <button class="btn btn-primary" onclick="createCourse()">
        <span class="fa fa-plus bold"></span>
    </button>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="course-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Course</th>
                    <th>Deskripsi</th>
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
    courseTable = $('#course-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: `${baseCourseUrl}?ajax=1`,
        columns: [
            { data: 'name' },
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

function createCourse() {
    $.get(`${baseCourseUrl}/create?ajax=1`, function(response) {
        Swal.fire({
            title: 'Tambah Lab Course',
            html: response,
            width: 600,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary btn-md px-4 mr-1',
                cancelButton: 'btn btn-danger btn-md px-4'
            },
            preConfirm: () => storeCourse()
        });
    });
}

function storeCourse() {
    $.post(`${baseCourseUrl}/store`, $('#form-create-course').serialize(), function() {
        Swal.close();
        courseTable.ajax.reload(null, false);

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Lab Course berhasil ditambahkan.',
            timer: 1500,
            showConfirmButton: false
        });
    });
}

function editCourse(id) {
    $.get(`${baseCourseUrl}/edit/${id}?ajax=1`, function(response) {
        Swal.fire({
            title: 'Edit Lab Course',
            html: response,
            width: 600,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Batal',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-warning btn-md mr-1 px-4 text-white',
                cancelButton: 'btn btn-danger btn-md px-4'
            },
            preConfirm: () => updateCourse()
        });
    });
}

function updateCourse() {
    $.post(`${baseCourseUrl}/update`, $('#form-edit-course').serialize(), function() {
        Swal.close();
        courseTable.ajax.reload(null, false);

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Lab Course berhasil diperbarui.',
            timer: 1500,
            showConfirmButton: false
        });
    });
}

function deleteCourse(id) {
    swalConfirm('Hapus course ini?', function() {
        $.get(`${baseCourseUrl}/delete/${id}`, function() {
            courseTable.ajax.reload(null, false);

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
