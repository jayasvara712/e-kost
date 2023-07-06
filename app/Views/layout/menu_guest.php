<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">

    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>

    </form>

</nav>

<div class="main-sidebar">
    <aside id="hide-sidebar-mini">
        <div class="sidebar-brand">
            <a href="<?= base_url() ?>">E-Kost</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/" .<?= session('role') ?>>E-Kost</a>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item" id="m-home">
                <a href="<?= site_url("/") ?>" class="nav-link <?= session('pembayaran') == 'yes' ? 'disabled' : '' ?>"><i class="fas fa-door-open"></i><span>Home</span></a>
            </li>
            <li class="nav-item" id="m-denah">
                <a href="<?= site_url("/denah") ?>" class="nav-link"><i class="fas fa-map-marked"></i><span>Denah</span></a>
            </li>

        </ul>
    </aside>
</div>