
<h1>Edit Akun</h1>

<form action="/user/update/<?= $user['id_ms_user'] ?>" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" required>
    </div>
    <div class="form-group">
        <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select class="form-control" id="role" name="role" required>
            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="operator" <?= $user['role'] == 'operator' ? 'selected' : '' ?>>Operator</option>
        </select>
    </div>
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama'] ?>" required>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="aktif" <?= $user['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
            <option value="tidak aktif" <?= $user['status'] == 'tidak aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

