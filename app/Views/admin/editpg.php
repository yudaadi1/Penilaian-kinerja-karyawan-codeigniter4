
<?= $this->extend('template/default') ?>

<?= $this->section('menu') ?>
<?= $this->include('template/menu1') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1><?=$title?></h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Edit Data Pegawai</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('updatedata/'.$user['id']); ?>" method="post">
                            <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input type="text" name="nama"  value="<?= $user['nama']; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="Nip">Nip:</label>
                                <input type="text" name="nip" value="<?= $user['nip']; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat:</label>
                                <input type="text" name="alamat"  value="<?= $user['alamat']; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password"  value="<?= $user['password']; ?>" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input class="form-check-group" type="checkbox" id="showPassword" onclick="tampilpassword()"
                                style="margin-top:2px;">
                                <span>Tampilkan Password</span>
                            </div>
                            <div class="form-group">
                                <label for="id_level">level:</label>
                                <select name="id_level" class="form-control" required>
                                    <option value="1" <?= $user['id_level'] == 1 ? 'selected' : ''; ?>>Admin</option>
                                    <option value="2" <?= $user['id_level'] == 2 ? 'selected' : ''; ?>>Pegawai</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_jabatan">Jabatan:</label>
                                <select name="id_jabatan" class="form-control" required>
                                    <?php foreach ($jabatan as $jbt) : ?>
                                        <option value="<?= $jbt['id'] ?>" <?= $jbt['id'] == $user['id_jabatan'] ? 'selected' : ''; ?>><?= $jbt['jabatan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" id="tambah">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function tampilpassword() {
      const passwordInput = document.getElementById('password');
      const showPasswordCheckbox = document.getElementById('showPassword');

      if (showPasswordCheckbox.checked) {
        passwordInput.type = 'text';
      } else {
        passwordInput.type = 'password';
      }
    }
  </script>
</section>

<?= $this->endSection() ?>
