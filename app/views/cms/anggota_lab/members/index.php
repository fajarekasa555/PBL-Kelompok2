<?php
use App\Helpers\Routing;
$route = new Routing();
$baseMembersUrl = $route->base_url('members');
?>

<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen Dosen</span>
    <a href="<?= $baseMembersUrl ?>/create" class="btn btn-primary">
        <span class="fa fa-plus"></span> Tambah
    </a>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="members-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th width="140" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>

let membersTable;
const baseMembersUrl = '<?= $baseMembersUrl ?>';

$(function() {
    membersTable = $('#members-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: `${baseMembersUrl}?ajax=1`,
        columns: [
            { data: 'name' },
            { data: 'jabatan', defaultContent: '-' },
            { data: 'email', defaultContent: '-' },
            { data: 'phone', defaultContent: '-' },
            { 
                data: 'action',
                orderable: false,
                searchable: false,
                className: 'text-center'
            }
        ]
    });
});

function initFilePond(selector) {
    return FilePond.create(document.querySelector(selector), {
        storeAsFile: true,
        allowMultiple: false,
        instantUpload: false,

        labelIdle: 'Drag & Drop foto atau <span class="filepond--label-action">Browse</span>',
        acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
        maxFileSize: '2MB',
        credits: false,
    });
}

function editMember(id) {
    window.location.href = `${baseMembersUrl}/edit/${id}`;
}


function deleteMember(id) {
    swalConfirm('Hapus anggota ini?', function() {
        $.get(`${baseMembersUrl}/delete/${id}`)
            .done(() => {
                membersTable.ajax.reload(null, false);
                Swal.fire({
                    icon: 'success',
                    title: 'Dihapus',
                    text: 'Data anggota telah dihapus.',
                    timer: 1300,
                    showConfirmButton: false
                });
            })
            .fail(() => {
                Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data.', 'error');
            });
    });
}

function showMember(id) {
    $.get(`${baseMembersUrl}/show/${id}?ajax=1`, function(response) {
        Swal.fire({
            html: response,
            width: 800,
            showCloseButton: true,
            showConfirmButton: false
        });
    }).fail(() => {
        Swal.fire('Gagal', 'Data anggota tidak ditemukan.', 'error');
    });
}
</script>
