
<script>
$(function() {
    // Template untuk setiap section
    const templates = {
        social: `
            <div class="row dynamic-row social-row">
                <div class="col-12 mb-2">
                    <span class="row-number"></span>
                    <strong>Media Sosial</strong>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Platform <span class="text-danger">*</span></label>
                    <select class="form-control social-platform-select" name="social[platform][]" required>
                        <option value="">-- Pilih Platform --</option>
                        <optgroup label="Media Sosial">
                            <option value="Facebook" data-icon="fab fa-facebook">Facebook</option>
                            <option value="Instagram" data-icon="fab fa-instagram">Instagram</option>
                            <option value="X / Twitter" data-icon="fab fa-twitter">X / Twitter</option>
                            <option value="LinkedIn" data-icon="fab fa-linkedin">LinkedIn</option>
                            <option value="YouTube" data-icon="fab fa-youtube">YouTube</option>
                            <option value="TikTok" data-icon="fab fa-tiktok">TikTok</option>
                            <option value="GitHub" data-icon="fab fa-github">GitHub</option>
                        </optgroup>
                        <optgroup label="Platform Akademik">
                            <option value="Google Scholar" data-icon="fas fa-graduation-cap">Google Scholar</option>
                            <option value="ResearchGate" data-icon="fab fa-researchgate">ResearchGate</option>
                            <option value="ORCID" data-icon="fab fa-orcid">ORCID</option>
                            <option value="Sinta" data-icon="fas fa-university">Sinta</option>
                            <option value="Scopus" data-icon="fas fa-book">Scopus</option>
                        </optgroup>
                        <optgroup label="Lainnya">
                            <option value="Website" data-icon="fas fa-globe">Website Pribadi</option>
                            <option value="Email" data-icon="fas fa-envelope">Email</option>
                            <option value="Portfolio" data-icon="fas fa-briefcase">Portfolio</option>
                        </optgroup>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Icon</label>
                    <div class="d-flex align-items-center gap-2">
                        <input type="text" name="social[icon][]" class="form-control social-icon-input" 
                               placeholder="Otomatis terisi" readonly style="flex: 1;">
                        <i class="social-icon-preview" style="font-size: 24px; width: 30px; text-align: center;"></i>
                    </div>
                    <small class="text-muted">Otomatis terisi</small>
                </div>
                <div class="col-md-4">
                    <label class="form-label">URL <span class="text-danger">*</span></label>
                    <input type="url" name="social[url][]" class="form-control" 
                           placeholder="https://..." required>
                </div>
                <div class="col-md-1 d-flex align-items-end justify-content-center">
                    <span class="remove-btn" title="Hapus">&times;</span>
                </div>
            </div>
        `,
        cert: `
            <div class="row dynamic-row cert-row">
                <div class="col-12 mb-2">
                    <span class="row-number"></span>
                    <strong>Sertifikasi</strong>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Judul Sertifikasi <span class="text-danger">*</span></label>
                    <input type="text" name="cert[title][]" class="form-control" 
                           placeholder="Nama sertifikat" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Penerbit <span class="text-danger">*</span></label>
                    <input type="text" name="cert[issuer][]" class="form-control" 
                           placeholder="Institusi penerbit" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Tanggal Terbit</label>
                    <input type="date" name="cert[issue_date][]" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Tanggal Expired</label>
                    <input type="date" name="cert[expiration_date][]" class="form-control">
                </div>
                <div class="col-md-1 d-flex align-items-end justify-content-center">
                    <span class="remove-btn" title="Hapus">&times;</span>
                </div>
                <div class="col-md-5 mt-2">
                    <label class="form-label">ID Kredensial (Opsional)</label>
                    <input type="text" name="cert[credential_id][]" class="form-control" 
                           placeholder="Contoh: ABCD-1234-EFGH">
                </div>
                <div class="col-md-6 mt-2">
                    <label class="form-label">URL Sertifikat (Opsional)</label>
                    <input type="url" name="cert[credential_url][]" class="form-control" 
                           placeholder="Contoh: https://www.sumanto.com/...">
                </div>
            </div>
        `,
        edu: `
            <div class="row dynamic-row edu-row">
                <div class="col-12 mb-2">
                    <span class="row-number"></span>
                    <strong>Pendidikan</strong>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Gelar <span class="text-danger">*</span></label>
                    <input type="text" name="edu[degree][]" class="form-control" 
                           placeholder="S1, S2, S3" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                    <input type="text" name="edu[major][]" class="form-control" 
                           placeholder="Nama jurusan" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Institusi <span class="text-danger">*</span></label>
                    <input type="text" name="edu[institution][]" class="form-control" 
                           placeholder="Nama universitas" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Tahun Lulus</label>
                    <input type="number" name="edu[start_year][]" class="form-control" 
                           placeholder="2020" min="1950" max="2100">
                </div>
                <div class="col-md-1 d-flex align-items-end justify-content-center">
                    <span class="remove-btn" title="Hapus">&times;</span>
                </div>
            </div>
        `,
        course: `
            <div class="row dynamic-row course-row">
                <div class="col-12 mb-2">
                    <span class="row-number"></span>
                    <strong>Mata Kuliah</strong>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Semester <span class="text-danger">*</span></label>
                    <select class="form-control course-semester-select" name="course[semester][]" required>
                        <option value="">-- Pilih --</option>
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label class="form-label">Nama Mata Kuliah <span class="text-danger">*</span></label>
                    <input type="text" name="course[course_name][]" class="form-control" 
                           placeholder="Contoh: Pemrograman Web" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Kode MK</label>
                    <input type="text" name="course[course_code][]" class="form-control" 
                           placeholder="TIF101">
                </div>
                <div class="col-md-2">
                    <label class="form-label">SKS</label>
                    <input type="number" name="course[credits][]" class="form-control" 
                           placeholder="3" min="1" max="6">
                </div>
                <div class="col-md-1 d-flex align-items-end justify-content-center">
                    <span class="remove-btn" title="Hapus">&times;</span>
                </div>
            </div>
        `
    };

    // Fungsi untuk update nomor urut
    function updateRowNumbers(container) {
        const rows = container.find('.dynamic-row');
        rows.each(function(index) {
            $(this).find('.row-number').text(index + 1);
        });
        
        // Toggle empty state
        const emptyState = container.siblings('.empty-state');
        if (rows.length === 0) {
            emptyState.addClass('show');
        } else {
            emptyState.removeClass('show');
        }
    }

    // Fungsi untuk menambah row baru
    function addRow(type) {
        const container = $(`#${type}-container`);
        const newRow = $(templates[type]);
        container.append(newRow);
        updateRowNumbers(container);
        
        // Initialize Select2 untuk row baru
        if (type === 'social') {
            initializeSocialMediaSelect(newRow);
        } else if (type === 'course') {
            initializeCourseSelect(newRow);
        }
        
        // Smooth scroll ke row baru
        $('html, body').animate({
            scrollTop: newRow.offset().top - 100
        }, 500);
        
        // Focus ke input pertama
        if (type === 'social' || type === 'course') {
            newRow.find('select:first').select2('open');
        } else {
            newRow.find('input:first').focus();
        }
    }

    // Initialize Select2 untuk Social Media
    function initializeSocialMediaSelect(row) {
        const selectElement = row.find('.social-platform-select');
        const iconInput = row.find('.social-icon-input');
        const iconPreview = row.find('.social-icon-preview');
        
        selectElement.select2({
            placeholder: '-- Pilih Platform --',
            allowClear: true,
            width: '100%'
        });
        
        // Event handler untuk auto-fill icon
        selectElement.on('change', function() {
            const selectedOption = $(this).find('option:selected');
            const iconClass = selectedOption.data('icon');
            
            if (iconClass) {
                iconInput.val(iconClass);
                iconPreview.attr('class', 'social-icon-preview ' + iconClass);
            } else {
                iconInput.val('');
                iconPreview.attr('class', 'social-icon-preview');
            }
        });
    }

    // Initialize Select2 untuk Course Semester
    function initializeCourseSelect(row) {
        const selectElement = row.find('.course-semester-select');
        
        selectElement.select2({
            placeholder: '-- Pilih Semester --',
            allowClear: true,
            width: '100%',
            minimumResultsForSearch: -1 // Hide search box karena hanya 2 pilihan
        });
    }

    // Event delegation untuk tombol hapus
    $(document).on('click', '.remove-btn', function() {
        const row = $(this).closest('.dynamic-row');
        const container = $(this).closest('[id$="-container"]');
        
        // Konfirmasi sebelum hapus menggunakan SweetAlert
        Swal.fire({
            title: 'Hapus Item?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                row.fadeOut(300, function() {
                    $(this).remove();
                    updateRowNumbers(container);
                    
                    // Toast notification setelah berhasil dihapus
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Item berhasil dihapus',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                });
            }
        });
    });

    // Event listener untuk tombol tambah
    $('#add-social').on('click', function() { addRow('social'); });
    $('#add-cert').on('click', function() { addRow('cert'); });
    $('#add-edu').on('click', function() { addRow('edu'); });
    $('#add-course').on('click', function() { addRow('course'); });

    // Initialize empty state pada load
    ['social', 'cert', 'edu', 'course'].forEach(type => {
        updateRowNumbers($(`#${type}-container`));
    });

    // Initialize existing Select2 elements (untuk mode edit)
    $('.social-platform-select').each(function() {
        const row = $(this).closest('.dynamic-row');
        initializeSocialMediaSelect(row);
    });

    $('.course-semester-select').each(function() {
        const row = $(this).closest('.dynamic-row');
        initializeCourseSelect(row);
    });

    // Validasi form sebelum submit
    $('form').on('submit', function(e) {
        let isValid = true;
        let errorFields = [];
        
        // Validasi setiap dynamic row
        $('.dynamic-row').each(function() {
            $(this).find('input[required], select[required]').each(function() {
                const fieldValue = $(this).val();
                if (!fieldValue || (Array.isArray(fieldValue) && fieldValue.length === 0)) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                    
                    // Ambil label field untuk pesan error
                    const label = $(this).closest('.col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6').find('label').text().replace('*', '').trim();
                    if (label && !errorFields.includes(label)) {
                        errorFields.push(label);
                    }
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
        });

        if (!isValid) {
            e.preventDefault();
            
            Swal.fire({
                icon: 'error',
                title: 'Form Tidak Lengkap',
                html: 'Mohon lengkapi field yang wajib diisi:<br><br>' + 
                      '<strong>' + errorFields.join(', ') + '</strong>',
                confirmButtonColor: '#007bff',
                confirmButtonText: 'OK, Saya Mengerti'
            });
            
            return false;
        }
    });

    $(document).on('input', '.is-invalid', function() {
        $(this).removeClass('is-invalid');
    });
});
</script>