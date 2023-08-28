<?= $this->extend('template/default') ?>

<?= $this->section('menu') ?>
<?= $this->include('template/menu1') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
  <div class="section-header">
    <h1>Laporan By Pegawai</h1>
  </div>
  <div class="section-body">
    <div class="row">
      <?php foreach ($users as $user) : ?>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <a href="<?= base_url('Data-kurja/' . $user['id']) ?>">
          <div class="card card-statistic-1">
            <div class="card-icon dynamic-color">
              <i class="fas fa-user"></i>
            </div>

            <div class="card-wrap">
              <div class="card-header">
                <h4 style="color: black;"><?= $user['nama'] ?></h4>
              </div>
            </div>
          </div>
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

</section>
<?= $this->endSection() ?>
