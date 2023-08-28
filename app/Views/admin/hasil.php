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
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Hasil Pencarian</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($kinerja)): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
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
                                <th>status</th>
                                <th>bulan</th>
                                <th>tahun</th>
                                <th>bukti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kinerja as $item): ?>
                            <tr>
                                <td><?= $item['no'] ?></td>
                                <td><?= $item['sasaran'] ?></td>
                                <td><?= $item['indikator'] ?></td>
                                <td><?= number_format($item['ktahunan_target'], 2) ?>%</td>
                                <td><?= number_format($item['ktribulan_target'], 2) ?>%</td>
                                <td> Rp.<?= number_format($item['anggaran_target'], 0, ',', '.') ?></td>
                                <td><?= $item['ktahunan_realisasi'] ?>%</td>
                                <td><?= $item['ktribulan_realisasi'] ?>%</td>
                                <td> Rp.<?= number_format($item['anggaran_realisasi'], 0, ',', '.') ?></td>
                                <td><?= $item['persentase_ktahunan'] ?></td>
                                <td><?= $item['persentase_ktribulan'] ?></td>
                                <td><?= $item['persentase_anggaran'] ?></td>
                                <td><?= $item['status'] ?></td>
                                <td><?= $item['bulan'] ?></td>
                                <td><?= date('d F Y', strtotime($item['tahun'])) ?></td>
                                <td>
                                <?php if ($item['file_name']): ?>
                                <a href="<?= base_url('/writable/bukti/' . $item['file_name']) ?>"
                                    download="<?= $item['file_name'] ?>">Download</a>
                                <?php else: ?>
                                No File Available
                                <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <p>Data tidak ditemukan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
    </div>
</section>
<?= $this->endSection() ?>