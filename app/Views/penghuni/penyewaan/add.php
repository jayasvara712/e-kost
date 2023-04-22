<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Sewa Kamar</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="<?= site_url($url) ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <?= csrf_field() ?>


                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label>No Invoice</label>
                                        <input type="text" class="form-control" name="no_nvoice" id="no_invoice" value="<?= $no_invoice ?>" readonly>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Tanggal Pemesanan</label>
                                        <input type="date" class="form-control" name="tgl_penyewaan" id="tgl_penyewaan" value="<?= date('Y-m-d') ?>">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Nama Penghuni</label>
                                        <input type="hidden" class="form-control" name="id_penghuni" id="id_penghuni" value="<?= session('id_penghuni') ?>">
                                        <input type="text" class="form-control" value="<?= session('name') ?>" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label>Nomor Kamar</label>
                                        <input type="hidden" class="form-control" name="no_nvoice" id="nomor_kamar">
                                        <select name="id_kamar" class="form-control" id="id_kamar">
                                            <option>Pilih Nomor Kamar</option>
                                            <?php foreach ($kamar as $key => $value) : ?>
                                                <option value="<?= $value->id_kamar ?>" <?= ($value->id_kamar == old('id_kamar')) ? 'selected' : '' ?>><?= $value->nomor_kamar ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Status Kamar</label>
                                        <input type="text" class="form-control" name="status_kamar" id="status_kamar" value="" readonly>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Lama Penyewaan</label>
                                        <select name="lama_penyewaan" class="form-control" id="lama_penyewaan">
                                            <?php for ($i = 1; $i <= 12; $i++) { ?>
                                                <option value="<?= $i ?>" <?= ($i == old('lama_penyewaan')) ? 'selected' : '' ?>><?= $i ?> Bulan</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Fasilitas</label>
                                    <input type="text" class="form-control" name="fasilitas" id="fasilitas" value="<?= old('fasilitas') ?>" readonly>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label>Harga Kamar</label>
                                        <input type="text" class="form-control currency" name="harga_kamar" id="harga_kamar" readonly>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Harga Total</label>
                                        <input type="text" class="form-control currency" name="total_harga" id="total_harga" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-success"><i class="fas fa-save"></i> Sewa</button>
                                    <button class="btn btn-primary" id="tombolPay"><i class="fas fa-save"></i> Bayar</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?= $this->endSection(); ?>