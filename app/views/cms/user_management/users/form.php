<div class="mb-3 text-left">
    <label>Username</label>
    <input type="text" class="form-control" id="username" name="username" value="<?= isset($user_edit) && $user_edit != '' ? $user_edit['username'] : '' ?>" placeholder="Masukkan username" required autocomplete="off">
</div>

<div class="mb-3 text-left">
    <label>Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="<?= isset($user_edit) ? 'Kosongkan jika tidak diubah' : 'Masukkan password' ?>" <?= isset($user_edit) && $user_edit != '' ? '' : 'required' ?> autocomplete="off">
</div>

<div class="mb-3 text-left">
    <label>Role</label>
    <select class="form-control" id="role_id" name="role_id" required>
        <option value="">-- Pilih Role --</option>
        <?php foreach ($roles as $role): ?>
            <option value="<?= $role['id'] ?>" 
                <?= isset($user_edit) && $user_edit != '' && $user_edit['role_id'] == $role['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($role['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>