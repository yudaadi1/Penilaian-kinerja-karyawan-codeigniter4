<?= $this->extend('template/default') ?>

<?= $this->section('menu') ?>
<?= $this->include('template/menu1') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
            <h1>Admin</h1>
    </div>
          <div class="section-body">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Pegawai</h4>
                  </div>
                  <div class="card-body">
                    <?=$totaluser?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                <i class="fas fa-stream"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Jabatan</h4>
                  </div>
                  <div class="card-body">
                  <?=$totaljabatan?>
                  </div>
                </div>
              </div>
            </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-success">
                  <i class="fas fa-chart-bar"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Total level</h4>
                    </div>
                    <div class="card-body">
                    <?=$totallevel?>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
</section>
<?= $this->endSection() ?>