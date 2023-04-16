<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>

    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="<?= base_url() ?>/stisla/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Admin</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="#" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="logout" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url() ?>"><?= getenv('judul_web'); ?></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#"><?= getenv('judul_web'); ?></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item" id="m-dashboard">
                <a href="<?= site_url("/dashboard") ?>" class="nav-link"><i class="fas fa-house"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-header">Data Master</li>

            <li class="nav-item dropdown" id="m-page">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-layer-group"></i> <span>Data Master</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item" id="m-fasilitas">
                        <a href="<?= site_url("/fasilitas") ?>" class="nav-link"><i class="fas fa-people-roof"></i><span>Data Fasilitas</span></a>
                    </li>
                    <li class="nav-item" id="m-kamar">
                        <a href="<?= site_url("/kamar") ?>" class="nav-link"><i class="fas fa-house-user"></i><span>Data Kamar</span></a>
                    </li>
                </ul>
            </li>

            <li class="menu-header">Penghuni dan Penyewaan</li>

            <li class="nav-item" id="m-penghuni">
                <a href="<?= site_url("/penghuni") ?>" class="nav-link"><i class="fas fa-user"></i><span>Data Penghuni</span></a>
            </li>
            <li class="nav-item" id="m-penyewaan">
                <a href="<?= site_url("/penyewaan") ?>" class="nav-link"><i class="fas fa-door-open"></i><span>Data Penyewaan Kos</span></a>
            </li>

            <li class="menu-header">Data Pembayaran Kos</li>

            <li class="nav-item" id="m-pembayaran">
                <a href="<?= site_url("/pembayaran") ?>" class="nav-link"><i class="fas fa-wallet"></i><span>Data Pembayaran</span></a>
            </li>

            <li class="menu-header">Data Laporan</li>

            <li class="nav-item" id="m-laporan">
                <a href="<?= site_url("/laporan") ?>" class="nav-link"><i class="fas fa-file-invoice"></i><span>Data Laporan</span></a>
            </li>

        </ul>
    </aside>
</div>