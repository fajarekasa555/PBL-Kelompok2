<?php
use App\Helpers\Routing;
$route = new Routing();
$baseMembersUrl = $route->base_url('members');
?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Anggota Lab</h5>
    </div>
    <div class="card-body">
        <form id="form-create-members" enctype="multipart/form-data">
            <?php include __DIR__ . '/form.php'; ?>
        </form>
    </div>
    <div class="card-footer">
        <button type="submit" form="form-create-members" class="btn btn-primary">
            <span class="fa fa-save"></span> Simpan
        </button>
        <a href="<?= $baseMembersUrl ?>" class="btn btn-secondary">
            <span class="fa fa-arrow-left"></span> Kembali
        </a>
    </div>
</div>
<?php include __DIR__ . '/form_script.php'; ?>
<script>
$(function() {
    const baseMembersUrl = '<?= $baseMembersUrl ?>';
    $('.multiple-select2').select2({
        width: '100%',
        placeholder: "Pilih bidang keahlian"
    }).trigger('change');

    initFilePond('.filepond');

    $('#form-create-members').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: `${baseMembersUrl}/store`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        timer: 1000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = baseMembersUrl;
                    });
                } else {
                    Swal.fire('Gagal', response.message, 'error');
                }
            },
            error: function(xhr) {
                let msg = 'Terjadi kesalahan saat menambahkan data.';
                if(xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                Swal.fire('Gagal', msg, 'error');
            }
        });
    });
});

</script>
