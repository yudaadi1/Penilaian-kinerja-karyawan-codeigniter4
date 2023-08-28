<!-- admin/editsubkinerja.php -->
<?= $this->extend('template/default') ?>

<?= $this->section('menu') ?>
<?= $this->include('template/menu1') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
  <div class="section-header">
    <h1>Edit Sub Kinerja</h1>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Edit Sub Kinerja</h4>
          </div>
          <div class="card-body">
            <form action="<?= base_url('updatesub/' . $subItem['id']) ?>" method="POST">
              <!-- Tampilkan data subkinerja yang akan diubah -->
              <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status">
                  <option value="diterima" <?= ($subItem['status'] === 'diterima') ? 'selected' : '' ?>>Diterima</option>
                  <option value="ditolak" <?= ($subItem['status'] === 'ditolak') ? 'selected' : '' ?>>Ditolak</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Update Status</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
