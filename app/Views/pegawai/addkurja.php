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
                       
                            <form action="<?= base_url('Savekurja'); ?>" method="post" enctype="multipart/form-data">
                                <div class="dynamic-fields-container">
                                <div class="form-group">
                                    <label for="nama">No : </label>
                                    <input type="text" name="entries[0][no]" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Sasaran Strategis </label>
                                    <input type="text" name="entries[0][sasaran]" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="Nip">Indikator Kinerja </label>
                                    <input type="text" name="entries[0][indikator]" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Target Kinerja Dan Anggaran</label>
                                    <span>
                                        <input type="text" name="entries[0][anggaran_target]" class="form-control"
                                            placeholder="Rp" required>
                                        <br>
                                        <input type="text" name="entries[0][ktahunan_target]" class="form-control"
                                            placeholder="K Tahunan" required>
                                        <br>
                                        <input type="text" name="entries[0][ktribulan_target]" class="form-control"
                                            placeholder="K Tribulanan" required>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Realisasi Kinerja dan Anggaran:</label>
                                    <span>
                                        <input type="text" name="entries[0][anggaran_realisasi]" class="form-control"
                                            placeholder="Rp" required>
                                        <br>
                                        <input type="text" name="entries[0][ktribulan_realisasi]" class="form-control"
                                            placeholder="K Tribulanan" required>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Bulan Ke :</label>
                                    <input type="text" name="entries[0][bulan]" class="form-control" placeholder="Contoh 1" required>
                                </div>
                                </div>
                                <div class="form">
                                <label for="password">Bukti :</label>
                                    <input type="file" name="bukti"  placeholder="upload file bukti" accept=".pdf,.doc,.docx,.xls,.xlsx" required>
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
                                <label for="nama">No:</label>
                                <input type="text" name="entries[${entryCount}][no]" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Sasaran Strategis:</label>
                                <input type="text" name="entries[${entryCount}][sasaran]" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="Nip">Indikator Kinerja:</label>
                                <input type="text" name="entries[${entryCount}][indikator]" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Target Kinerja Dan Anggaran</label>
                                <span>
                                    <input type="text" name="entries[${entryCount}][anggaran_target]" class="form-control" placeholder="Rp" required>
                                    <br>
                                    <input type="text" name="entries[${entryCount}][ktahunan_target]" class="form-control" placeholder="K Tahunan" required>
                                    <br>
                                    <input type="text" name="entries[${entryCount}][ktribulan_target]" class="form-control" placeholder="K Tribulanan" required>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="password">Realisasi Kinerja dan Anggaran:</label>
                                <span>
                                    <input type="text" name="entries[${entryCount}][anggaran_realisasi]" class="form-control" placeholder="Rp" required>
                                    <br>
                                    <input type="text" name="entries[${entryCount}][ktribulan_realisasi]" class="form-control" placeholder="K Tribulanan" required>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="password">Bulan Ke:</label>
                                <input type="text" name="entries[${entryCount}][bulan]" class="form-control" placeholder="Contoh 1" required>
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
