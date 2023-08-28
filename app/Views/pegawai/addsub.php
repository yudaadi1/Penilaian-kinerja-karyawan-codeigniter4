<?= $this->extend('template/default') ?>

<?= $this->section('menu') ?>
<?= $this->include('template/menu1') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="loading-screen" class="loading-screen">
    <div class="loading-spinner"></div>
</div>
<section class="section">
    <div class="section-header">
        <h1><?=$title?></h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Data Karyawan</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('Savesub'); ?>" method="post" enctype="multipart/form-data">
                            <div class="dynamic-fields-container">
                                <div class="form-group">
                                    <label for="id_kinerja">Nomer Kinerja:</label>
                                    <select name="entries[0][id_kinerja]" id="id_kinerja" class="form-control">
                                        <?php foreach ($kinerja as $kinerjaOption): ?>
                                        <option value="<?= $kinerjaOption['id'] ?>"><?= $kinerjaOption['no'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="nama">No : </label>
                                    <input type="text" name="entries[0][no]" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Program/Nama Kegiatan/Nama Sub Kegiatan:</label>
                                    <input type="text" name="entries[0][nm_program]" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="Nip">Indikator Kinerja </label>
                                    <input type="text" name="entries[0][indikator]" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Target Kinerja Dan Anggaran</label>
                                    <span>
                                        <input type="text" name="entries[0][target_thn]" class="form-control"
                                            placeholder="K Tahunan" required>
                                        <br>
                                        <input type="text" name="entries[0][target_bln]" class="form-control"
                                            placeholder="K Tribulanan" required>
                                        <br>
                                        <input type="text" name="entries[0][target_nilai]" class="form-control"
                                            placeholder="Rp" required>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Realisasi Kinerja dan Anggaran:</label>
                                    <span>
                                        <input type="text" name="entries[0][realisasi_thn]" class="form-control"
                                            placeholder="KTahunan" required>
                                        <br>
                                        <input type="text" name="entries[0][realisasi_bln]" class="form-control"
                                            placeholder="K Tribulan" required>
                                        <br>
                                        <input type="text" name="entries[0][realisasi_nilai]" class="form-control"
                                            placeholder="Rp" required>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="password">capaian Kinerja dan Anggaran:</label>
                                    <span>
                                        <input type="text" name="entries[0][h_thn]" class="form-control"
                                            placeholder="K Tribulanan" required>
                                        <br>
                                        <input type="text" name="entries[0][h_bln]" class="form-control"
                                            placeholder="K Tahunan" required>
                                        <br>
                                        <input type="text" name="entries[0][h_nilai]" class="form-control"
                                            placeholder="Rp" required>
                                    </span>
                                </div>
                            </div>
                            <div class="form">
                                <label for="bukti">File Bukti:</label>
                                <select name="bukti" id="bukti" class="form-control">
                                    <?php foreach ($bukti as $b): ?>
                                    <option value="<?= $b['id'] ?>"><?= $b['file'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <br>
                            <button type="button" class="btn btn-primary" id="add-entry">Add Entry</button>
                            <button type="submit" class="btn btn-success" id="submit-form">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const addButton = document.getElementById("add-entry");
            const dynamicFieldsContainer = document.querySelector(".dynamic-fields-container");
            let entryCount = 0;

            addButton.addEventListener("click", function () {
                entryCount++;

                const dynamicFields = `
                    <div class="card mb-3 dynamic-entry">
                        <div class="card-header">
                            <h5>Form Tambah Data Karyawan ${entryCount}</h5>
                        </div>
                        <div class="card-body">
                        <div class="form-group">
                        <label for="id_kinerja">Select Kinerja:</label>
                        <select name="entries[${entryCount}][id_kinerja]" class="form-control">
                            <?php foreach ($kinerja as $kinerjaOption): ?>
                                <option value="<?= $kinerjaOption['id'] ?>"><?= $kinerjaOption['sasaran'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                            <div class="form-group">
                                <label for="nama">No:</label>
                                <input type="text" name="entries[${entryCount}][no]" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="program">Nama Program/Nama Kegiatan/Nama Sub Kegiatan:</label>
                                <input type="text" name="entries[${entryCount}][nm_program]" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="indikator">Indikator Kinerja:</label>
                                <input type="text" name="entries[${entryCount}][indikator]" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Target Kinerja Dan Anggaran</label>
                                <span>
                                    <input type="text" name="entries[${entryCount}][target_thn]" class="form-control" placeholder="K Tahunan" required>
                                    <br>
                                    <input type="text" name="entries[${entryCount}][target_bln]" class="form-control" placeholder="K Tribulanan" required>
                                    <br>
                                    <input type="text" name="entries[${entryCount}][target_nilai]" class="form-control" placeholder="Rp" required>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="password">Realisasi Kinerja dan Anggaran:</label>
                                <span>
                                <input type="text" name="entries[${entryCount}][realisasi_thn]" class="form-control" placeholder="K Tahunan" required>
                                    <br>
                                    <input type="text" name="entries[${entryCount}][realisasi_bln]" class="form-control" placeholder="K Tribulanan" required>
                                    <br>
                                    <input type="text" name="entries[${entryCount}][realisasi_nilai]" class="form-control" placeholder="Rp" required>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="password">Capaian Dan Hasil Kinerja :</label>
                                <span>
                                <input type="text" name="entries[${entryCount}][h_thn]" class="form-control" placeholder="K Tahunan" required>
                                    <br>
                                    <input type="text" name="entries[${entryCount}][h_bln]" class="form-control" placeholder="K Tribulanan" required>
                                    <br>
                                    <input type="text" name="entries[${entryCount}][h_nilai]" class="form-control" placeholder="Rp" required>
                                </span>
                            </div>
                        </div>
                    </div>
                `;

                const dynamicFieldsWrapper = document.createElement("div");
                dynamicFieldsWrapper.innerHTML = dynamicFields;
                dynamicFieldsContainer.appendChild(dynamicFieldsWrapper);
            });
        });
    </script>
</section>

<?= $this->endSection() ?>