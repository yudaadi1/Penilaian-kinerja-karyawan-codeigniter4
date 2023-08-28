
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
                        <h4>Form Tambah  Jabatan</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('Tambah-jbt'); ?>" method="post">
                            <div class="form-group">
                                <label for="jabatan">jabatan :</label>
                                <input type="text" name="jabatan" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary" id="tambah">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
