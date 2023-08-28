<?= $this->extend('template/default') ?>

<?= $this->section('menu') ?>
<?= $this->include('template/menu1') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
  <div class="section-header">
    <h1>Data Laporan Kinerja Pegawai</h1>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4><?= $title; ?></h4><br>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered" id="laporan" style="width:100%">
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
                    <th>Persentase Ktahunan</th>
                    <th>Persentase Ktribulan</th>
                    <th>Persentase Anggaran</th>
                    <th>Status</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Hapus</th>
                    <th>Edit</th>
                    <th>Subkinerja</th>
                    <th>File Bukti</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($kinerja as $item) : ?>
                <tr>
                    <td><?= $item['no'] ?></td>
                    <td><?= $item['sasaran'] ?></td>
                    <td><?= $item['indikator'] ?></td>
                    <td><?= $item['ktahunan_target'] ?></td>
                    <td><?= $item['ktribulan_target'] ?></td>
                    <td><?= $item['anggaran_target'] ?></td>
                    <td><?= $item['ktahunan_realisasi'] ?></td>
                    <td><?= $item['ktribulan_realisasi'] ?></td>
                    <td><?= $item['anggaran_realisasi'] ?></td>
                    <td><?= is_numeric($item['persentase_ktahunan']) ? number_format($item['persentase_ktahunan'], 2) . '%' : $item['persentase_ktahunan'] ?></td>
                    <td><?= is_numeric($item['persentase_ktribulan']) ? number_format($item['persentase_ktribulan'], 2) . '%' : $item['persentase_ktribulan'] ?></td>
                    <td><?= is_numeric($item['persentase_anggaran']) ? number_format($item['persentase_anggaran'], 2) . '%' : $item['persentase_anggaran'] ?></td>
                    <td><?= $item['status'] ?></td>
                    <td><?= $item['bulan'] ?></td>
                    <td><?= date('l,d F Y', strtotime($item['tahun'])) ?></td>
                    <td>
                    <form method="post" action="<?= base_url('laporan/hapuskinerja/' . $item['id']) ?>">
                        <input type="hidden">
                        <button type="submit" class="btn btn-danger"> <i class="fas fa-trash-alt"></i></button>
                    </form>
                    </td>
                    <td>
                    <form method="get" action="<?= base_url('editkinerja/' . $item['id']) ?>">
                        <input type="hidden">
                        <button type="submit" class="btn btn-primary"> <i class="far fa-edit"></i></button>
                    </form> 
                    </td>
                    <td>
                      <a href="<?= base_url('subkinerja/' . $item['id']) ?>" class="btn btn-primary"><i class="fas fa-database"></i></a>
                   </td>
                   <td>
                      <?php if (!empty($item['file'])) : ?>
                          <a class="btn btn-success" href="<?= base_url('writable/bukti/' . $item['file']) ?>" target="_blank" download><i class="fas fa-download"></i></a>
                      <?php else : ?>
                          Tidak Ada Bukti
                      <?php endif; ?>
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