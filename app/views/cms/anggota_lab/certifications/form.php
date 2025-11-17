<div class="mb-3 text-left">
    <label>Anggota / Dosen</label>
    <select class="form-control select2-member" name="member_id" required>
        <option value="">-- Pilih Anggota --</option>
        <?php foreach ($members as $m): ?>
            <option value="<?= $m['id'] ?>"
                <?= (isset($cert['member_id']) && $cert['member_id'] == $m['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($m['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="mb-3 text-left">
    <label>Nama Sertifikasi</label>
    <input 
        type="text" 
        class="form-control"
        name="title" 
        value="<?= htmlspecialchars($cert['title'] ?? '') ?>" 
        placeholder="Contoh: AWS Certified Cloud Practitioner"
        required
        autocomplete="off">
</div>

<div class="mb-3 text-left">
    <label>Diterbitkan Oleh</label>
    <input 
        type="text" 
        class="form-control" 
        name="issuer" 
        value="<?= htmlspecialchars($cert['issuer'] ?? '') ?>" 
        placeholder="Contoh: Amazon Web Services"
        required
        autocomplete="off">
</div>

<div class="row">
    <div class="col-md-6 mb-3 text-left">
        <label>Tanggal Terbit</label>
        <input 
            type="text"
            class="form-control datepicker-issue"
            name="issue_date"
            value="<?= htmlspecialchars($cert['issue_date'] ?? '') ?>"
            required>
    </div>

    <div class="col-md-6 mb-3 text-left">
        <label>Tanggal Kadaluarsa</label>
        <input 
            type="text"
            class="form-control datepicker-exp"
            name="expiration_date"
            value="<?= htmlspecialchars($cert['expiration_date'] ?? '') ?>">
    </div>
</div>

<div class="mb-3 text-left">
    <label>ID Kredensial (Opsional)</label>
    <input 
        type="text" 
        class="form-control" 
        name="credential_id" 
        value="<?= htmlspecialchars($cert['credential_id'] ?? '') ?>"
        placeholder="Contoh: ABCD-1234-EFGH">
</div>

<div class="mb-3 text-left">
    <label>URL Sertifikat (Opsional)</label>
    <input 
        type="url" 
        class="form-control" 
        name="credential_url" 
        value="<?= htmlspecialchars($cert['credential_url'] ?? '') ?>"
        placeholder="Contoh: https://www.credly.com/...">
</div>
