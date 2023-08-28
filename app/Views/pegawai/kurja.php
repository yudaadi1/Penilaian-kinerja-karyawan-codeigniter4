<?= $this->extend('template/default') ?>

<?= $this->section('menu') ?>
<?= $this->include('template/menu1') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
  <div class="section-header">
    <h1><?=$title?></h1>
  </div>
  <div>
    <a href="<?= base_url() ?>" class="btn btn-md btn-success" style="width:150px;">
      <i class="fas fa-file-pdf"></i>Cetak PDF
    </a>

    <a href="<?= base_url() ?>" class="btn btn-md btn-primary" style="width:150px;">
      <i class="fas fa-file-excel"></i> Cetak Excel
    </a>
    <a href="<?= base_url('Add-Kurja') ?>" class="btn btn-md btn-primary" style="width:170px;">
      <i class="fas fa-table"></i> Tambah Data Kurja
    </a>
  </div>
  <br>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card  ">
          <div class="card-header">
            <h4><?= $title ?></h4><br>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered"  id="kurja-table" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Sasaran</th>
                    <th>Indikator</th>
                    <th>Ktahunan Target</th>
                    <th>Ktribulan Target</th>
                    <th>Anggaran Target</th>
                    <th>Ktahunan Realisasi</th>
                    <th>Ktribulan Realisasi</th>
                    <th>Anggaran Realisasi</th>
                    <th>Persentase Ktribulan</th>
                    <th>Persentase Ktahunan</th>
                    <th>Persentase Anggaran</th>
                    <th>status</th>
                    <th>bulan</th>
                    <th>tahun</th>
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

