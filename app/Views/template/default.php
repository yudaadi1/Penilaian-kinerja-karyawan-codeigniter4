<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?=$title?></title>

    <link rel="stylesheet" href="<?=base_url()?>/writable/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/writable/template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/writable/template/assets/css/style.css">
    <link rel="stylesheet" href="<?=base_url()?>/writable/template/assets/css/components.css">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>/writable/template/node_modules/datatablesnet-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/writable/template/node_modules/datatablesnet-select-bs4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="<?=base_url()?>/writable/main.css">
    

</head>

<body>
<div id="loading-screen" class="loading-screen">
    <div class="loading-spinner"></div>
</div>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <div class="navbar-nav navbar-right">
                    <div class="nav-link nav-link-lg nav-link-user">
                            <img  src="<?=base_url()?>/writable/template/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm d-lg-inline">
                                <?php if (session()->get('id_level') === '2'): ?>
                                <?= session()->get('nama') ?>
                                <?php elseif (session()->get('id_level') === '1'): ?>
                                 <?= session()->get('nama') ?>
                                <?php endif; ?>
                            </div>
                    </div>
                 </div>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">Dinkopum Jombang</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">Dk</a>
                    </div>
                    <ul class="sidebar-menu">
                        <?= $this->renderSection('menu') ?>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <?= $this->renderSection('content') ?>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2023 <div class="bullet"></div> Design By Maha Dev
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="<?=base_url()?>/writable/template/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?=base_url()?>/writable/template/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?=base_url()?>/writable/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>/writable/template/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?=base_url()?>/writable/template/node_modules/moment/min/moment.min.js"></script>
    <script src="<?=base_url()?>/writable/template/assets/js/stisla.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.js"></script>
    <script src="<?=base_url()?>/writable/template/node_modules/datatablesnet-select-bs4/js/select.bootstrap4.min.js"></script>
  <script src=" <?=base_url()?>/writable/template/assets/js/scripts.js"> </script> 
  <script src="<?=base_url()?>/writable/template/assets/js/custom.js"></script>
  <script>
   document.addEventListener("DOMContentLoaded", function () {
    const loadingScreen = document.getElementById("loading-screen");
    const logoutBtn = document.getElementById("logoutBtn");

    const links = document.querySelectorAll("a"); // Select all anchor links on the page

    links.forEach(link => {
        link.addEventListener("click", function (event) {
            if (link !== logoutBtn) {
                loadingScreen.style.display = "flex"; // Show loading screen

                // You can add a delay here to simulate loading, or you can remove this delay
                setTimeout(function () {
                    loadingScreen.style.display = "none"; // Hide loading screen
                }, 1000); // Adjust the delay time as needed
            }
        });
    });
});
    window.addEventListener('beforeunload', function () {
            document.getElementById('loading-screen').style.display = 'flex';
        });

        window.addEventListener('load', function () {
            document.getElementById('loading-screen').style.display = 'none';
        });
  </script>
  <!-- <script>
    var BASE_URL = 'http://localhost/crud/';
    document.addEventListener('DOMContentLoaded', init, false);
    function init() {
     if ('serviceWorker' in navigator && navigator.onLine) {
        navigator.serviceWorker.register(BASE_URL + 'service-worker.js')
            .then((reg) => {

            }, (err) => {

        });
        }
    }
</script> -->
    <?php if (session()->has('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?= session()->getFlashdata('success'); ?>',
            });
        </script>
        
    <?php endif; ?>  
<script>
    document.getElementById('logoutBtn').addEventListener('click', function(event) {
        event.preventDefault();
        Swal.fire({
           icon:'question',
            title: 'Logout',
            text: 'Apakah Anda Ingin Logout Sekarang ?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Logout'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url('logout'); ?>';
            }
        });
    });
  
</script>
<script>
    $(document).ready(function() {
      $("#pegawaiTable").DataTable({
        order: [[2, 'asc']],
        rowGroup: {
        'dataSrc': 2
    },
            "fixedHeader": true ,
            "processing": false,
            "serverSide": true,
            "responsive":true,
            "scrollY": "400px",
            "scrollCollapse": true,
            "scrollX": true, 
       
        "ajax": {
          "url": "<?= base_url('admin/fetchPegawaiData') ?>",
          "type": "POST"
        },
        "columns": [
          { "data": "No" },
          { "data": "Nama" },
          { "data": "Username" },
          { "data": "Alamat" },
          { "data": "level" },
          { "data": "Jabatan" },
          { "data": "Aksi" }
        ],
        "createdRow": function(row, data, dataIndex) {
        $(row).find('.action-buttons button').addClass('btn btn-sm');
      }
      });
    });

    $(document).ready(function () {
        new DataTable('#kurja-table',{  "scrollCollapse": true,
        "scrollX": true, // Mengaktifkan scrolling horizontal jika diperlukan
             "fixedHeader": true ,
            "processing": false,
            "serverSide": true,
            "responsive":true,
            "pageLength": 20, // Menampilkan 10 baris per halaman
            "scrollY": "400px",
            "scrollCollapse": true,
            "scrollX": true, // Mengaktifkan scrolling horizontal jika diperlukan
            ajax: {
                url: '<?= base_url('kurja/kurja') ?>',
                type: 'post',
                dataSrc: 'data'
            },
            columns: [
                { data: 'no' },
                { data: 'sasaran' },
                { data: 'indikator' },
                { data: 'ktahunan_target',
                    render: function (data) {
                    return data + '%'; // Append '%' to the value to show it as a percentage
                }
                },
                { data: 'ktribulan_target',
                    render: function (data) {
                    return data + '%'; // Append '%' to the value to show it as a percentage
                }
                },
                { data: 'anggaran_target',
                    render: function (data) {
                    if (!isNaN(data)) {
                        return parseFloat(data).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                    }
                    return data;
                }
                
                },
                { data: 'ktahunan_realisasi',
                    render: function (data) {
                    return data + '%'; // Append '%' to the value to show it as a percentage
                }
                },
                { data: 'ktribulan_realisasi',
                    render: function (data) {
                    return data + '%'; // Append '%' to the value to show it as a percentage
                }
                },
                { data: 'anggaran_realisasi', 
                    render: function (data) {
                    if (!isNaN(data)) {
                        return parseFloat(data).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                    }
                    return data;
                }
                },
                { data: 'persentase_ktribulan',
                    render: function (data) {
                    if (data !== 'N/A') {
                        return data.toFixed(2) + '%';
                    }
                    return data;
                }
                },
                { data: 'persentase_ktahunan',
                    render: function (data) {
                    if (data !== 'N/A') {
                        return data.toFixed(2) + '%';
                    }
                    return data;
                }
                },
                { data: 'persentase_anggaran',
                     render: function (data) {
                    if (data !== 'N/A') {
                        return data.toFixed(2) + '%';
                    }
                    return data;
                }
                },
                { data: 'status' },
                { data: 'bulan' },
                { data: 'tahun',
                render: function (data) {
                    var date = new Date(data);
                    var month = date.toLocaleString('id-ID', { month: 'short' });
                    var year = date.getFullYear();
                    var day = date.getDate();
                    return `${day} ${month} ${year} `;  // Menampilkan tahun dari data tanggal
                }
            }
               
            ]
        });
    });
  </script>
 <script>
    $(document).ready(function() {
        $('#subkinerja').DataTable({
            "fixedHeader": true,
            "responsive": true,
            "scrollY": "400px",
            "scrollCollapse": true,
            "scrollX": true,
            "searching": false,
        });
    });
    $(document).ready(function() {
        $('#laporan').DataTable({
            "fixedHeader": true,
            "responsive": true,
            "scrollY": "400px",
            "scrollCollapse": true,
            "scrollX": true,
            "searching": false,
        });
    });
</script>
<script>
    // Mendapatkan semua elemen dengan kelas 'dynamic-color'
    var dynamicIcons = document.querySelectorAll('.dynamic-color');

    // Loop melalui setiap elemen dan mengubah warna latar belakang
    dynamicIcons.forEach(function(icon) {
        // Fungsi untuk menghasilkan warna acak
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Mengubah warna latar belakang elemen menjadi warna acak
        icon.style.backgroundColor = getRandomColor();
    });
</script>
</body>

</html>