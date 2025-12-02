<?php
use App\Helpers\Routing;
$route = new Routing();
$baseMembersUrl = $route->base_url('members');
$baseUrl = $route->base_url();
?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Ubah Anggota Lab</h5>
    </div>
    <div class="card-body">
        <form id="form-edit-members" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $members['id'] ?>">
            <?php include __DIR__ . '/form.php'; ?>
        </form>
    </div>
    <div class="card-footer">
        <button type="submit" form="form-edit-members" class="btn btn-primary">
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
        placeholder: "Pilih bidang keahlian",
        width: '100%'
    }).trigger('change');

    const pond = initFilePond('.filepond');

    const existingPhoto = $('#existing_photo').val();
    if (existingPhoto !== '') {
        pond.addFile('<?= $baseUrl ?>' + 'public/' + existingPhoto);
    }

    $('#form-edit-members').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: `${baseMembersUrl}/update`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response.status);
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
                let msg = 'Terjadi kesalahan saat memperbarui data.';
                if(xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                Swal.fire('Gagal', msg, 'error');
            }
        });
    });
});
</script>
