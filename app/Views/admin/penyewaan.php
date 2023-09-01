<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Data Penyewaan Kos</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data Penyewaan Kos</a></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <?php if (session()->getFlashdata('success')) : ?>
                            <div id="success" style="visibility: hidden">
                                <?= session()->getFlashdata('success') ?>
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
                                                    <?php
                                                    if ($value->last_transaction_status == 'pending') {
                                                        echo "<span class='badge badge-warning'><i class='fas fa-clock'></i> Menunggu Pembayaran</span>";
                                                    } else if ($value->last_transaction_status == 'settlement') {
                                                        echo "<span class='badge badge-success'><i class='fas fa-check'></i> Sudah Terbayar</span>";
                                                    } else if ($value->last_transaction_status == 'expire') {
                                                        echo "<span class='badge badge-danger'><i class='fas fa-times'></i> Pembayaran Kadaluarsa</span>";
                                                    } else if ($value->last_transaction_status == 'cancel') {
                                                        echo "<span class='badge badge-danger'><i class='fas fa-times'></i> Pemesanan Dibatalkkan</span>";
                                                    } else {
                                                        "<span class='badge badge-success'><i class='fas fa-check'></i></span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="<?= site_url($url . '/detail_penyewaan/' .  $value->id_penyewaan) ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
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