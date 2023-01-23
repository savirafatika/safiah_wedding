<!DOCTYPE html>
<html lang="id">

<head>
     <meta charset="UTF-8">
     <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
     <title>Safiah_Wedding <?= '| ' . $title; ?></title>
     <link rel="icon" href="<?= base_url(); ?>/assets/img/institusi.png" type="image/png">

     <!-- General CSS Files -->
     <link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/fontawesome/css/all.min.css">

     <!-- CSS Libraries -->
     <link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/datatables/datatables.min.css">
     <link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
     <link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/select2/dist/css/select2.min.css">
     <link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/summernote/summernote-bs4.css">
     <link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/codemirror/lib/codemirror.css">
     <link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/codemirror/theme/duotone-dark.css">
     <link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/jquery-selectric/selectric.css">
     <link rel="stylesheet" href="<?= base_url(); ?>/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

     <!-- Template CSS -->
     <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style.css">
     <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/components.css">
     <!-- Start GA -->
     <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
     <script>
          window.dataLayer = window.dataLayer || [];

          function gtag() {
               dataLayer.push(arguments);
          }
          gtag('js', new Date());

          gtag('config', 'UA-94034622-3');
     </script>
     <!-- /END GA -->
</head>

<body>
     <div id="app">
          <div class="main-wrapper main-wrapper-1">
               <!-- Top Bar -->
               <?= $this->include('templates/topbar'); ?>

               <!-- Side Bar -->
               <?= $this->include('templates/sidebar'); ?>

               <!-- Main Content -->
               <?= $this->renderSection('page-content'); ?>

               <footer class="main-footer">
                    <div class="footer-left">
                         Copyright &copy; Safiah_Wedding 2023
                    </div>
                    <div class="footer-right">

                    </div>
               </footer>
          </div>
     </div>

     <!-- General JS Scripts -->
     <script src="<?= base_url(); ?>/assets/modules/jquery.min.js"></script>
     <script src="<?= base_url(); ?>/assets/modules/popper.js"></script>
     <script src="<?= base_url(); ?>/assets/modules/tooltip.js"></script>
     <script src="<?= base_url(); ?>/assets/modules/bootstrap/js/bootstrap.min.js"></script>
     <script src="<?= base_url(); ?>/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
     <script src="<?= base_url(); ?>/assets/modules/moment.min.js"></script>
     <script src="<?= base_url(); ?>/assets/js/stisla.js"></script>

     <!-- JS Libraies -->
     <script src="<?= base_url(); ?>/assets/modules/cleave-js/dist/cleave.min.js"></script>
     <script src="<?= base_url(); ?>/assets/modules/cleave-js/dist/addons/cleave-phone.us.js"></script>
     <script src="<?= base_url(); ?>/assets/modules/datatables/datatables.min.js"></script>
     <script src="<?= base_url(); ?>/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
     <script src="<?= base_url(); ?>/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
     <script src="<?= base_url(); ?>/assets/modules/jquery-ui/jquery-ui.min.js"></script>
     <script src="<?= base_url(); ?>/assets/modules/select2/dist/js/select2.full.min.js"></script>
     <script src="<?= base_url(); ?>/assets/modules/summernote/summernote-bs4.js"></script>
     <script src="<?= base_url(); ?>/assets/modules/codemirror/lib/codemirror.js"></script>
     <script src="<?= base_url(); ?>/assets/modules/codemirror/mode/javascript/javascript.js"></script>
     <script src="<?= base_url(); ?>/assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
     <script src="<?= base_url(); ?>/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
     <script src="<?= base_url(); ?>/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

     <!-- Page Specific JS File -->
     <script src="<?= base_url(); ?>/assets/js/page/modules-datatables.js"></script>
     <script src="<?= base_url(); ?>/assets/js/page/forms-advanced-forms.js"></script>
     <script src="<?= base_url(); ?>/assets/js/page/features-post-create.js"></script>
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

     <!-- Template JS File -->
     <script src="<?= base_url(); ?>/assets/js/scripts.js"></script>
     <script src="<?= base_url(); ?>/assets/js/custom.js"></script>

     <script type="text/javascript">
          $(document).ready(function() {
               $('select.select2#grup_pengguna').select2({
                    placeholder: "Pilih Peran Pengguna",
                    allowClear: true,
               });

               $('form').each(function() {
                    var form = $(this),
                         reset = form.find(':reset'),
                         inputs = form.find(':input');

                    reset.on('click', function() {
                         setTimeout(function() {
                              inputs.trigger('change');
                         }, 50);
                    });
               });
          });
     </script>

     <!-- Show hide password -->
     <script type="text/javascript">
          $(document).ready(function() {
               $("#show_hide_password a").on('click', function(event) {
                    event.preventDefault();
                    if ($('#show_hide_password input').attr("type") == "text") {
                         $('#show_hide_password input').attr('type', 'password');
                         $('#show_hide_password i').addClass("fa-eye-slash");
                         $('#show_hide_password i').removeClass("fa-eye");
                    } else if ($('#show_hide_password input').attr("type") == "password") {
                         $('#show_hide_password input').attr('type', 'text');
                         $('#show_hide_password i').removeClass("fa-eye-slash");
                         $('#show_hide_password i').addClass("fa-eye");
                    }
               });
               $("#show_hide_password2 a").on('click', function(event) {
                    event.preventDefault();
                    if ($('#show_hide_password2 input').attr("type") == "text") {
                         $('#show_hide_password2 input').attr('type', 'password');
                         $('#show_hide_password2 i').addClass("fa-eye-slash");
                         $('#show_hide_password2 i').removeClass("fa-eye");
                    } else if ($('#show_hide_password2 input').attr("type") == "password") {
                         $('#show_hide_password2 input').attr('type', 'text');
                         $('#show_hide_password2 i').removeClass("fa-eye-slash");
                         $('#show_hide_password2 i').addClass("fa-eye");
                    }
               });
          });
     </script>

</body>

</html>