<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Penyewaan Kamar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Penghuni</a></div>
                <div class="breadcrumb-item">Penyewaan Kamar</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <?php if (session()->getFlashdata('success')) : ?>
                            <div class="alert alert-success alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">x</button>
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Kamar</th>
                                            <th>Tanggal Sewa</th>
                                            <th>Pembayaran</th>
                                            <th>Pembayaran Terakhir</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($penyewaan as $key => $value) : ?>
                                            <tr>
                                                <td>
                                                    <?= $key + 1 ?>
                                                </td>
                                                <td>
                                                    <?= $value->nomor_kamar ?>
                                                </td>
                                                <td>
                                                    <?= $value->tgl_penyewaan ?>
                                                </td>
                                                <td>
                                                    <?= $value->payment_period . ' / ' . $value->lama_penyewaan ?> Bulan
                                                </td>
                                                <td>
                                                    <?= $value->last_transaction_time ?>
                                                </td>
                                                <td>
                                                    <?php if ($value->payment_method == 'M') {
                                                        if ($value->last_transaction_status == 'pending') {
                                                            echo "<span class='badge badge-warning'><i class='fas fa-clock'></i> Menunggu Pembayaran</span>";
                                                        } else if ($value->last_transaction_status == 'settlement') {
                                                            echo "<span class='badge badge-success'><i class='fas fa-check'></i> Sudah Terbayar</span>";
                                                        } else if ($value->last_transaction_status == 'expire') {
                                                            echo "<span class='badge badge-danger'><i class='fas fa-times'></i> Pembayaran Kadaluarsa</span>";
                                                        } else {
                                                            echo "<span class='badge badge-danger'><i class='fas fa-times'></i> Pemesanan Dibatalkkan</span>";
                                                        }
                                                    } else {
                                                        "<span class='badge badge-success'><i class='fas fa-check'></i></span>";
                                                    } ?>
                                                </td>
                                                <td>
                                                    <a href="<?= site_url($url . '/detail_penyewaan/' .  $value->id_penyewaan) ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                    <?php if ($value->payment_method == 'M') {
                                                        if ($status[$key] <= $value->lama_penyewaan) {
                                                    ?>
                                                            <?php if ($value->last_transaction_status != 'cancel') { ?>
                                                                <?php if ($value->last_transaction_status == 'settlement' && $value->payment_period < $value->lama_penyewaan) { ?>
                                                                    <a href="<?= site_url($url . "/bayar/" . $value->id_penyewaan) ?>" class="btn btn-primary"><i class="fas fa-credit-card"></i></a>
                                                                <?php } ?>
                                                                <?php if ($value->payment_period <= 1 && $value->last_transaction_status != 'settlement') { ?>
                                                                    <button class="btn btn-danger" id="btn<?= $key ?>" type="button" onclick="action(<?= $key ?>,<?= $value->id_penyewaan ?>,'<?= '/' . $url . '/'  ?>','cancel','<?= $alert ?>')"><i class="fas fa-times"></i></button>
                                                                <?php } ?>
                                                            <?php } ?>

                                                    <?php }
                                                    } ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?= $this->endSection(); ?>