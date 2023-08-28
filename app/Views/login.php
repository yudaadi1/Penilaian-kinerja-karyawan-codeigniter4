<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?=base_url()?>/writable/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/writable/template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
  <link rel="manifest" href="manifest.json">
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?=base_url()?>/writable/template/node_modules/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=base_url()?>/writable/template/assets/css/style.css">
  <link rel="stylesheet" href="<?=base_url()?>/writable/template/assets/css/components.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="<?=base_url()?>/writable/template/assets/img/stisla-fill.svg" alt="logo" width="100"
                class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>

              <div class="card-body">
                <form method="post" action="<?=base_url('Login')?>">
                  <div class="form-group">
                    <label for="Nip">NIP :</label>
                    <input id="nip" type="text" class="form-control" name="nip" tabindex="1" required>
                    <div class="invalid-feedback">
                      Masukkan Username
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      Masukkan Password
                    </div>

                  </div>
                  <div class="form-group">
                    <input class="form-check-group" type="checkbox" id="showPassword" onclick="tampilpassword()"
                      style="margin-top:2px;">
                    <span>Tampilkan Password</span>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Xuilong
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script>
    function tampilpassword() {
      const passwordInput = document.getElementById('password');
      const showPasswordCheckbox = document.getElementById('showPassword');

      if (showPasswordCheckbox.checked) {
        passwordInput.type = 'text';
      } else {
        passwordInput.type = 'password';
      }
    }
  </script>
  <!-- General JS Scripts -->
  <script src="<?=base_url()?>/writable/template/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?=base_url()?>/writable/template/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="<?=base_url()?>/writable/template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?=base_url()?>/writable/template/node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
  <script src="<?=base_url()?>writable/template/node_modules/moment/min/moment.min.js"></script>
  <script src="<?=base_url()?>/writable/template/assets/js/stisla.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src=" <?=base_url()?>/writable/template/assets/js/scripts.js"> </script> 
  <script src="<?=base_url()?>/writable/template/assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script>
            var BASE_URL = 'http://localhost/crud/';
            document.addEventListener('DOMContentLoaded', init, false);
            function init() {
                if ('serviceWorker' in navigator && navigator.onLine) {
                    navigator.serviceWorker.register( BASE_URL + 'service-worker.js')
                    .then((reg) => {
                    }, (err) => {
                       
                    });
                }
            }
</script>
<?php if (session()->has('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?= session()->getFlashdata('success'); ?>'
            });
        </script>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?= session()->getFlashdata('error'); ?>'
            });
        </script>
    <?php endif; ?>
</body>

</html>
