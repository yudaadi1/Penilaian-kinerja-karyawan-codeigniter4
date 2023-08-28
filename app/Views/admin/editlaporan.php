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
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('updatestatus/'.$kinerja['id']) ?>" method="post">
                <div class="form-group">
                                <label for="new_status">Pilih Status Baru:</label>
                                <select name="new_status" class="form-control">
                                    <option value="ditinjau" <?= ($kinerja['status'] === 'ditinjau') ? 'selected' : '' ?>>Ditinjau</option>
                                    <option value="diterima" <?= ($kinerja['status'] === 'diterima') ? 'selected' : '' ?>>Diterima</option>
                                    <option value="ditolak" <?= ($kinerja['status'] === 'ditolak') ? 'selected' : '' ?>>Ditolak</option>
                                </select>
                            </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-danger" value="Go Back" onclick="history.back(-1)">Kembali</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
