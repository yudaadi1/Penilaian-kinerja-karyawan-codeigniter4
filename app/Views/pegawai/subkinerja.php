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
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <a href="<?= base_url('Tambahsub') ?>">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Tambah Data</h4>
              </div>
              <div class="card-body">
                Sub Kinerja
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
                    <h4>Cetak</h4>
                  </div>
                  <div class="card-body">
                  PDF
                  </div>
                </div>
          </div>
        </a>
      </div>
    </div>
        <div class="row">
            <div class="col-12">
                <div class="card  ">
                    <div class="card-header">
                        <h4><?= $title ?></h4><br>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="laporanTable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Program/Nama Kegiatan/Nama Sub Kegiatan</th>
                                        <th>Indikator</th>
                                        <th>Ktahunan Target</th>
                                        <th>Ktribulan Target</th>
                                        <th>Rp</th>
                                        <th>Ktahunan Realisasi</th>
                                        <th>Ktribulan Realisasi</th>
                                        <th>Rp</th>
                                        <th>capaian Ktribulan</th>
                                        <th>capaian Ktahunan</th>
                                        <th>capaian Anggaran</th>
                                        <th>status</th>
                                    </tr>
                                </thead>
                                <?php foreach ($sublist as $list): ?>
                                <tbody>
                                  <tr>
                                    <td><?= $list['no'] ?></td>
                                      <td><?= $list['nm_program'] ?></td>
                                      <td><?= $list['indikator'] ?></td>
                                      <td><?= $list['target_thn'] ?>%</td>
                                      <td><?= $list['target_bln'] ?>%</td>
                                      <td> Rp.<?=$list['target_nilai'] ?></td>
                                      <td><?= $list['realisasi_thn'] ?>%</td>
                                      <td><?= $list['realisasi_bln'] ?>%</td>
                                      <td> Rp.<?=$list['realisasi_nilai']?></td>
                                      <td><?= $list['h_thn'] ?>%</td>
                                      <td><?= $list['h_bln'] ?>%</td>
                                      <td><?= $list['h_nilai'] ?>%</td>
                                      <td><?= $list['status'] ?></td>
                                      </tr>
                                  <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


<?= $this->endSection() ?>
