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

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url(); ?>/asset/custom.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/stisla/assets/css/components.css">
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

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-sm main-navbar">
                <a href="index.html" class="navbar-brand sidebar-gone-hide"><?= getenv('judul_web') ?></a>
                <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
                <div class="nav-collapse">
                    <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                </div>

                <form class="form-inline ml-auto">
                </form>

                <ul class="navbar-nav navbar-right">
                    <li class="nav-item" id="m-home"><a href="/" class="nav-link"><i class="fas fa-home"></i> Kos</a></li>
                    <li class="nav-item" id="m-denah"><a href="/denah" class="nav-link"><i class="fas fa-map"></i> Denah</a></li>
                    <li class="nav-item"><a href="/login" class="nav-link btn btn-success"><i class="fas fa-door-open"></i> Masuk</a></li>
                    <?php if (session('role') == 'penghuni') { ?>
                        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-title">Logged in 5 min ago</div>
                                <a href="features-profile.html" class="dropdown-item has-icon">
                                    <i class="far fa-user"></i> Profile
                                </a>
                                <a href="features-activities.html" class="dropdown-item has-icon">
                                    <i class="fas fa-bolt"></i> Activities
                                </a>
                                <a href="features-settings.html" class="dropdown-item has-icon">
                                    <i class="fas fa-cog"></i> Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item has-icon text-danger">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </nav>

            <?= $this->renderSection('content'); ?>

            <?php
            include('footer.php');
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