<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h4>Data Laporan</h4>
                    </div>

                    <div class="card-body">
                        <div class="card-body">

                            <ul class="nav nav-tabs justify-content-center" id="myTab6" role="tablist">
                                <?php if (session()->role == 'admin') { ?>
                                    <li class="nav-item">
                                        <a class="nav-link text-center <?= session()->role == 'admin' ? 'active' : '' ?>" id="karyawan-tab6" data-toggle="tab" href="#karyawan" role="tab" aria-controls="karyawan" aria-selected="true">
                                            <span><i class="fas fa-user-tie"></i></span> Karyawan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-center" id="penghuni-tab6" data-toggle="tab" href="#penghuni" role="tab" aria-controls="penghuni" aria-selected="false">
                                            <span><i class="fas fa-user"></i></span> Penghuni</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-center" id="kamar-tab6" data-toggle="tab" href="#kamar" role="tab" aria-controls="kamar" aria-selected="false">
                                            <span><i class="fas fa-door-open"></i></span> Kamar</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-center" id="penyewaan-tab6" data-toggle="tab" href="#penyewaan" role="tab" aria-controls="penyewaan" aria-selected="false">
                                            <span><i class="fas fa-file-invoice"></i></span> Penyewaan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-center" id="pembayaran-tab6" data-toggle="tab" href="#pembayaran" role="tab" aria-controls="pembayaran" aria-selected="false">
                                            <span><i class="fas fa-credit-card"></i></span> Pembayaran</a>
                                    </li>
                                <?php } else if (session()->role == 'karyawan') { ?>
                                <?php } else if (session()->role == 'penghuni') { ?>
                                <?php } ?>
                            </ul>

                            <div class="tab-content tab-bordered" id="myTabContent6">

                                <div class="tab-pane fade show active" id="karyawan" role="tabpanel" aria-labelledby="karyawan">
                                    <center>
                                        <h2>Cetak Data Karyawan</h2>
                                        <a href="/<?= session()->role ?>/laporan/cetak_karyawan" class="btn btn-primary">Cetak <i class="fas fa-print"></i></a>
                                    </center>
                                </div>

                                <div class="tab-pane fade show" id="penghuni" role="tabpanel" aria-labelledby="penghuni">
                                    <center>
                                        <h2>Cetak Data Penghuni</h2>
                                        <a href="/<?= session()->role ?>/laporan/cetak_penghuni" class="btn btn-primary">Cetak <i class="fas fa-print"></i></a>
                                    </center>
                                </div>

                                <div class="tab-pane fade show" id="kamar" role="tabpanel" aria-labelledby="kamar">
                                    <center>
                                        <h2>Cetak Data Kamar</h2>
                                        <a href="/<?= session()->role ?>/laporan/cetak_kamar" class="btn btn-primary">Cetak <i class="fas fa-print"></i></a>
                                    </center>
                                </div>

                                <div class="tab-pane fade" id="penyewaan" role="tabpanel" aria-labelledby="penyewaan">
                                    <h2>Cetak Data Penyewaan</h2>
                                    <form action="/<?= session()->role ?>/laporan/cetak_penyewaan">
                                        <?= csrf_field() ?>

                                        <div class="form-group pilihan">
                                            <label for="">Bulan</label>
                                            <input type="month" name="bulan" class="form-control">
                                        </div>

                                        <div class="form-group pilihan">
                                            <label for="">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="all">Semua</option>
                                                <option value="settlement">Lunas</option>
                                                <option value="pending">Belum Lunas</option>
                                                <option value="cancel">Dibatalkan</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i> Cetak</button>
                                        </div>

                                    </form>
                                </div>

                                <div class="tab-pane fade" id="pembayaran" role="tabpanel" aria-labelledby="pembayaran">
                                    <h2>Cetak Data Pembayaran</h2>
                                    <form action="/<?= session()->role ?>/laporan/cetak_pembayaran">
                                        <?= csrf_field() ?>

                                        <div class="form-group pilihan" id="pilbulan">
                                            <label for="">Bulan</label>
                                            <input type="month" name="bulan" id="" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i> Cetak</button>
                                        </div>

                                    </form>
                                </div>

                            </div>

                        </div><!-- /.container-fluid -->

                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<?= $this->endSection(); ?>