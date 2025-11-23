<div class="mb-3 text-left">
    <label>Urutan</label>
    <input type="number" class="form-control" id="order_number" name="order_number"value="<?= $mission['order_number'] ?? ($order_number ?? 1) ?>" required readonly>
</div>
<div class="mb-3 text-left">
    <label>Misi</label>
    <textarea class="form-control" id="mission" name="mission" rows="4" placeholder="Masukkan Misi Laboratorium" required><?= $mission['mission'] ?? '' ?></textarea>
</div>



<!-- <div class="mb-3 text-left">
    <label>Status</label><br>
    <label class="switch">
        <input type="checkbox" 
               name="is_active" 
               <?= isset($mission['is_active']) ? ($mission['is_active'] ? 'checked' : '') : 'checked' ?>>
        <span class="slider round"></span>
    </label>
    <span class="ml-2">Aktif</span>
</div> -->
