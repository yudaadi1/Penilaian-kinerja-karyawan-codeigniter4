<li class="menu-header">Dashboard</li>
<?php if (session()->get('id_level') === '1'): ?>
<li class="nav-item">
    <a href="<?=base_url('Admin')?>" class=""><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
</li>
<li class="nav-item">
    <a href="<?=base_url('Data-Pegawai')?>" class=""><i class="fas fa-users"></i><span>Data Karyawan</span></a>
</li>

<li class="nav-item">
    <a href="<?=base_url('Laporan-Pegawai')?>" class=""><i class="fas fa-file-alt"></i><span>Laporan Kineja Pegawai</span></a>
</li>


<!-- sidebar pegawai -->
<?php elseif (session()->get('id_level') === '2') : ?>
<li class="nav-item">
    <a href="<?=base_url('Pegawai')?>" class=""><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
</li>
<li class="nav-item">
    <a href="<?=base_url('Kurja')?>" class=""><i class="fas fa-tasks"></i><span>Kurja Pegawai</span></a>
</li>
<li class="nav-item">
    <a href="<?=base_url('Subkinerja')?>" class=""><i class="fas fa-folder-open"></i><span>Capaian Hasil Monitoring</span></a>
</li>
<li class="nav-item">
    <a href="<?=base_url('History')?>" class=""><i class="fas fa-history"></i><span>History Laporan</span></a>
</li>
<?php endif; ?>

<!-- logout all level user -->
<li class="nav-item">
    <a href="<?=base_url('logout')?>" id="logoutBtn"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
</li>