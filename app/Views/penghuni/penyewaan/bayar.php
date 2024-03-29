<?= $this->extend('layout/template_penghuni'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">

        <div class="section-body">
            <form action="<?= $payment_method == 'C' ? site_url('/penyewaan_detail/payment') : '' ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <input type="hidden" name="no_invoice" id="no_invoice" value="<?= $no_invoice ?>">
                <input type="hidden" name="id_penyewaan" id="id_penyewaan" value="<?= $id_penyewaan ?>">
                <input type="hidden" name="periode" id="periode" value="<?= $period ?>">
                <input type="hidden" name="denda" id="denda" value="<?= $total_denda ?>">
                <input type="hidden" name="total_bayar" id="total_bayar" value="<?= $total_bayar ?>">

                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="invoice-title">
                                    <h2>Invoice</h2>
                                    <div class="invoice-number">#<?= $no_invoice ?></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Pemesan:</strong><br>
                                            <?= $nama_penghuni ?><br>
                                            <?= $no_telp_penghuni ?><br>
                                            <?= $alamat_penghuni ?><br>
                                        </address>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>Metode Pembayaran:</strong><br>
                                            <?php
                                            if ($payment_method == 'C') {
                                                echo "<span class='badge badge-success'><i class='fas fa-money-bill'></i> Cash</span>";
                                            } else if ($payment_method == 'M') {
                                                echo "<span class='badge badge-success'><i class='fas fa-credit-card'></i> Online</span>";
                                            }
                                            ?><br>
                                        </address>
                                        <address>
                                            <strong>Status:</strong><br>
                                            <?php
                                            if ($transaction_status == 'settlement') {
                                                echo "<span class='badge badge-success'>Sudah Di Bayar</span>";
                                            } else if ($transaction_status == 'pending') {
                                                echo "<span class='badge badge-warning'>Belum Di Bayar</span>";
                                            } else if ($transaction_status == 'failure') {
                                                echo "<span class='badge badge-danger'>Pembayaran Gagal</span>";
                                            } else if ($transaction_status == 'expire') {
                                                echo "<span class='badge badge-danger'>Pembayaran Kadaluarsa</span>";
                                            } else if ($transaction_status == 'cancel') {
                                                echo "<span class='badge badge-danger'>Pembayaran Dibatalkan</span>";
                                            }
                                            ?><br><br>
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>Tanggal Pemesanan:</strong><br>
                                            <?= $tgl_penyewaan ?><br><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="section-title">Detail Pemesanan</div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-md">
                                        <tr>
                                            <th>Nomor Kamar</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Tanggal Pembayaran</th>
                                            <th class="text-right">Pembayaran Ke</th>
                                        </tr>
                                        <tr>
                                            <td><?= $nomor_kamar ?></td>
                                            <td class="text-center">Rp.<?= $harga_kamar ?></td>
                                            <td class="text-center"><?= $transaction_time ?></td>
                                            <td class="text-right"><?= $period ?></td>
                                        </tr>
                                    </table>

                                    <?php if ($keterlambatan != '' && $keterlambatan != null) : ?>
                                        <table class="table table-striped table-hover table-md">
                                            <tr>
                                                <th>Keterlambatan</th>
                                                <th class="text-center">Denda</th>
                                            </tr>
                                            <tr>
                                                <td><?= $keterlambatan ?> Hari</td>
                                                <td class="text-center">Rp.<?= number_format($total_denda, 0, ',', '.') ?></td>
                                            </tr>
                                        </table>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-lg-12 text-right">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Total</div>
                                    <div class="invoice-detail-value invoice-detail-value-lg">Rp.<?= number_format($total_bayar, 0, ',', '.') ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-md-right">
                        <?php
                        if (session('pembayaran') == 'yes') { ?>
                            <?php if ($payment_method == 'C') { ?>
                                <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-money-bill"></i> Proses Pembayaran</button>
                            <?php } else if ($payment_method == 'M') { ?>
                                <button class="btn btn-primary btn-icon icon-left" id="btnBayar"><i class="fas fa-credit-card"></i> Proses Pembayaran</button>
                            <?php } ?>
                            <?php if (session('firstPay') == 'yes') { ?>
                                <div class="float-lg-left mb-lg-0 mb-3">
                                    <button class="btn btn-danger" id="btndelete1" type="button" onclick="deleteData(1,<?= $id_kamar ?>,'<?= '/' . $url ?>','<?= $alert ?>')"><i class="fas fa-times"></i> Cancel</button>
                                </div>
                            <?php } else { ?>
                                <div class="float-lg-left mb-lg-0 mb-3">
                                    <a href="<?= site_url($url . '/detail_penyewaan/' . $id_penyewaan) ?>" class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</a>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="float-lg-left mb-lg-0 mb-3">
                                <a href="<?= site_url($url . '/detail_penyewaan/' . $id_penyewaan) ?>" class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>