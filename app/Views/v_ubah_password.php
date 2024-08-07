<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
</head>
<body>
    <h1>Ubah Password</h1>
    <?php if (session()->getFlashdata('error')): ?>
        <div style="color: red;">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div style="color: green;">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <form action="/user/updatePassword" method="post">
        <div>
            <label for="old_password">Password Lama</label>
            <input type="password" id="old_password" name="old_password" required>
        </div>
        <div>
            <label for="new_password">Password Baru</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <div>
            <label for="confirm_new_password">Konfirmasi Password Baru</label>
            <input type="password" id="confirm_new_password" name="confirm_new_password" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
