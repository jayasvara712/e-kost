<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= getenv('judul_web'); ?></title>
    <link rel="icon" href="<?= base_url() ?>/asset/img/<?= getenv('logo') ?>" type="image/png">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/node_modules/@fortawesome/fontawesome-free/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/node_modules/chocolat/dist/css/chocolat.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/node_modules/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/node_modules/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/node_modules/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/node_modules/codemirror/theme/duotone-dark.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/node_modules/selectric/public/selectric.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/node_modules/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/assets/css/components.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/asset/backend.css">

    <!-- Start GA -->
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


<body class="<?= session('role') == 'penghuni' ? 'sidebar-mini' : '' ?>">

    <div id="app">
        <div class="main-wrapper">
            <?php
            if (session('isLoggedIn')) {
                include('menu.php');
            } else if (session('url') == 'home') {
                include('menu_guest.php');
            }
            ?>
            <?= $this->renderSection('content'); ?>

            <?php
            if (session('isLoggedIn')) {
                include('footer.php');
            }
            ?>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url(); ?>/stisla/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/moment/min/moment.min.js"></script>
    <script src="<?= base_url(); ?>/stisla/assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="<?= base_url(); ?>/stisla/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/cleave.js/dist/cleave.min.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/cleave.js/dist/addons/cleave-phone.id.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/select2/dist/js/select2.full.min.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/selectric/public/jquery.selectric.min.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/codemirror/lib/codemirror.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/codemirror/mode/javascript/javascript.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>/stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="<?= base_url(); ?>/stisla/assets/js/page/forms-advanced-forms.js"></script>
    <script src="<?= base_url(); ?>/stisla/assets/js/page/modules-datatables.js"></script>
    <script src="<?= base_url(); ?>/stisla/assets/js/page/auth-register.js"></script>

    <!-- sweet alert -->
    <script src="<?= base_url(); ?>/stisla/node_modules/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Template JS File -->
    <script src="<?= base_url(); ?>/stisla/assets/js/scripts.js"></script>
    <script src="<?= base_url(); ?>/stisla/assets/js/custom.js"></script>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= getenv('midtrans_client_key') ?>"></script>

    <!-- custom js -->
    <script>
        var csrfToken = "<?= csrf_token() ?>";
        var csrfHash = "<?= csrf_hash() ?>";
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script src="<?= base_url(); ?>/asset/js/custom.js"></script>
    <script src="<?= base_url(); ?>/asset/js/previewImage.js"></script>

</body>

</html>