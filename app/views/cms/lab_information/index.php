<?php
use App\Helpers\Routing;
$route = new Routing();
$baseUrl = $route->base_url('lab_information');
?>
<style>
    .textarea-wrapper {
        position: relative;
        width: 100%;
    }

    .textarea-modern {
        width: 100%;
        min-height: 120px;
        padding: 12px 14px;
        font-size: 15px;
        line-height: 1.5;
        border: 1px solid #ced4da;
        border-radius: 8px;
        resize: vertical;
        outline: none;
        transition: all .2s ease;
        background: #fdfdfd;
    }

    .textarea-modern:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13,110,253,0.15);
        background: #ffffff;
    }

    .textarea-label {
        font-weight: 600;
        margin-bottom: 6px;
        display: inline-block;
    }
</style>
<h1 class="page-header d-flex justify-content-between align-items-center">
    <span>Manajemen Lab Information</span>
    <button class="btn btn-primary" onclick="addRow()">
        <span class="fa fa-plus"></span> Tambah
    </button>
</h1>

<div class="panel panel-default">
    <div class="panel-body">
        <table id="labinfo-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="200">Key</th>
                    <th>Value</th>
                    <th width="150" class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
let labinfoTable;
const baseUrl = '<?= $baseUrl ?>';

$(function() {
    labinfoTable = $('#labinfo-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: `${baseUrl}?ajax=1`,
        rowId: function(a){ return 'row-' + a.id; },
        columns: [
            { data: 'key' },
            { data: 'value' },
            { 
                data: 'action',
                orderable: false,
                searchable: false,
                className: 'text-center'
            }
        ]
    });
});


function addRow() {
    const newRow = `
        <tr id="temp-row">
            <td>
                <input type="text" class="form-control" id="new_key" placeholder="Masukkan key...">
            </td>
            <td>
                <div class="textarea-wrapper">
                    <textarea id="new_value" name="value" class="textarea-modern" 
                        placeholder="Masukkan isi konten..."
                        oninput="autoResize(this)"></textarea>
                </div>
            </td>
            <td class="text-center">
                <button class="btn btn-success btn-sm" onclick="storeRow()">
                    <i class="fa fa-check"></i>
                </button>
                <button class="btn btn-danger btn-sm" onclick="$('#temp-row').remove()">
                    <i class="fa fa-times"></i>
                </button>
            </td>
        </tr>
    `;

    $('#labinfo-table tbody').prepend(newRow);
}


function storeRow() {
    const key = $('#new_key').val().trim();
    const value = $('#new_value').val().trim();

    if (!key || !value) {
        Swal.fire('Peringatan', 'Key dan value harus diisi!', 'warning');
        return;
    }

    Swal.showLoading();

    $.ajax({
        url: `${baseUrl}/store`,
        type: 'POST',
        data: { key: key, value: value },
        success: function() {
            $('#temp-row').remove();
            labinfoTable.ajax.reload(null, false);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil ditambahkan.',
                timer: 1500,
                showConfirmButton: false
            });
        },
        error: function() {
            Swal.fire('Gagal', 'Terjadi kesalahan saat menyimpan data.', 'error');
        }
    });
}


function editRow(id) {

    $.get(`${baseUrl}/edit/${id}`, function(res) {

        if (!res.success) {
            Swal.fire("Gagal", "Data tidak ditemukan", "error");
            return;
        }

        const row = res.data;
        const tr = $(`#row-${id}`);

        tr.data("old-key", row.key);
        tr.data("old-value", row.value);

        tr.html(`
            <td>
                <input type="text" class="form-control" id="edit_key_${id}" value="${row.key}">
            </td>
            <td>
                <div class="textarea-wrapper">
                    <textarea id="edit_value_${id}" name="edit_value_${id}" class="textarea-modern" 
                        placeholder="Masukkan isi konten..."
                        oninput="autoResize(this)">${row.value}</textarea>
                </div>
            </td>
            <td class="text-center">
                <button class="btn btn-success btn-sm mr-2" onclick="updateRow(${id})">
                    <i class="fa fa-check"></i>
                </button>
                <button class="btn btn-danger btn-sm" onclick="cancelEdit(${id})">
                    <i class="fa fa-times"></i>
                </button>
            </td>
        `);
    });
}


function cancelEdit(id) {
    const tr = $(`#row-${id}`);

    const key = tr.data("old-key");
    const value = tr.data("old-value");

    tr.html(`
        <td class="key">${key}</td>
        <td class="value">${value}</td>
        <td class="text-center">
            <button class="btn btn-warning btn-sm text-white" onclick="editRow(${id})">
                <i class="fa fa-edit"></i>
            </button>
            <button class="btn btn-danger btn-sm" onclick="deleteRow(${id})">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    `);
}


function updateRow(id) {

    const key = $(`#edit_key_${id}`).val().trim();
    const value = $(`#edit_value_${id}`).val().trim();

    if (!key || !value) {
        Swal.fire("Peringatan", "Key dan value wajib diisi!", "warning");
        return;
    }

    Swal.showLoading();

    $.ajax({
        url: `${baseUrl}/update/${id}`,
        type: 'POST',
        data: { key: key, value: value },
        success: function() {

            const tr = $(`#row-${id}`);

            tr.html(`
                <td class="key">${key}</td>
                <td class="value">${value}</td>
                <td class="text-center">
                    <button class="btn btn-warning btn-sm text-white" onclick="editRow(${id})">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="deleteRow(${id})">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            `);

            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "Data berhasil diperbarui.",
                timer: 1500,
                showConfirmButton: false
            });

        },
        error: function() {
            Swal.fire("Gagal", "Terjadi kesalahan saat update data", "error");
        }
    });
}

function deleteRow(id) {
    swalConfirm('Hapus data ini?', function() {
        $.get(`${baseUrl}/delete/${id}`)
            .done(() => {
                labinfoTable.ajax.reload(null, false);
                Swal.fire({
                    icon: 'success',
                    title: 'Dihapus',
                    text: 'Data telah dihapus.',
                    timer: 1300,
                    showConfirmButton: false
                });
            })
            .fail(() => {
                Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data.', 'error');
            });
    });
}

function autoResize(el) {
    el.style.height = "auto";
    el.style.height = (el.scrollHeight) + "px";
}
</script>
