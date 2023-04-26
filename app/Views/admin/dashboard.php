<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <?php if (session()->getFlashdata('success')) : ?>
                                <div id="success" style="visibility: hidden">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif ?>

                            <div class="row">

                                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1 card-primary">
                                        <div class="card-icon bg-primary">
                                            <i class="fas fa-bath"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Fasilitas</h4>
                                            </div>
                                            <div class="card-body">
                                                <?= $fasilitas ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1 card-primary">
                                        <div class="card-icon bg-primary">
                                            <i class="fas fa-door-open"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Kamar</h4>
                                            </div>
                                            <div class="card-body">
                                                <?= $kamar ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1 card-primary">
                                        <div class="card-icon bg-primary">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Penghuni</h4>
                                            </div>
                                            <div class="card-body">
                                                <?= $penghuni ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1 card-primary">
                                        <div class="card-icon bg-primary">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Karaywan</h4>
                                            </div>
                                            <div class="card-body">
                                                <?= $karyawan ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1 card-primary">
                                        <div class="card-icon bg-primary">
                                            <i class="fas fa-file-invoice"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Penyewaan</h4>
                                            </div>
                                            <div class="card-body">
                                                <?= $penyewaan ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
</div>

<?= $this->endSection(); ?>