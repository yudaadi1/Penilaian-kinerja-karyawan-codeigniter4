<?= $this->extend('template/default') ?>

<?= $this->section('menu') ?>
<?= $this->include('template/menu1') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
  <div class="section-header">
    <h1>Data Sub Kinerja</h1>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4><?$title?></h4><br>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="subkinerjaTable" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Program</th>
                    <th>Indikator</th>
                    <th>Ktahunan Target</th>
                    <th>Ktribulan Target</th>
                    <th>Anggaran Target</th>
                    <th>Ktahunan Realisasi</th>
                    <th>Ktribulan Realisasi</th>
                    <th>Anggaran Realisasi</th>
                    <th>Persentase Ktahunan</th>
                    <th>Persentase Ktribulan</th>
                    <th>Persentase Anggaran</th>
                    <th>Status</th>
                    <th>Bulan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($subkinerja as $item) : ?>
                  <tr>
                    <td><?= $item['no'] ?></td>
                    <td><?= $item['nm_program'] ?></td>
                    <td><?= $item['indikator'] ?></td>
                    <td><?= $item['target_thn'] ?></td>
                    <td><?= $item['target_bln'] ?></td>
                    <td><?= $item['target_nilai'] ?></td>
                    <td><?= $item['realisasi_thn'] ?></td>
                    <td><?= $item['realisasi_bln'] ?></td>
                    <td><?= $item['realisasi_nilai'] ?></td>
                    <td><?= $item['h_thn'] ?></td>
                    <td><?= $item['h_bln'] ?></td>
                    <td><?= $item['h_nilai'] ?></td>
                    <td><?= $item['status'] ?></td>
                    <td><?= date('d F Y', strtotime($item['bulan'])) ?></td>
                    <td>
                      <a href="<?= base_url('editsub/' . $item['id']) ?>" class="btn btn-info btn-sm">
                        <i class="far fa-edit"></i>
                      </a>
                    </td>
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
