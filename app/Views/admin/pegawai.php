<?= $this->extend('template/default') ?>

<?= $this->section('menu') ?>
<?= $this->include('template/menu1') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
  <div class="section-header">
    <h1>Data Pegawai</h1>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <a href="<?= base_url('Tambah-data-pegawai') ?>">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Tambah Data</h4>
              </div>
              <div class="card-body">
                  Pegawai
                  </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <a href="<?= base_url('Tambah-jabatan') ?>">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-plus"></i>
            </div>
            <div class="card-wrap">
                  <div class="card-header">
                    <h4>Tambah Jabatan</h4>
                  </div>
                  <div class="card-body">
                  Pegawai
                  </div>
                </div>
          </div>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4><?= $title ?></h4><br>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="pegawaiTable" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Nip</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Role</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>