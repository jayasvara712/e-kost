<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pembayaran Kamar No.<?= $no_kamar ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Karyawan</a></div>
                <div class="breadcrumb-item">Data Penyewaan Kos</div>
                <div class="breadcrumb-item">Kamar No.<?= $no_kamar ?></div>
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
                                            <th>No Invoice</th>
                                            <th>Pembayaran</th>
                                            <th>Tipe Pembayaran</th>
                                            <th>Tanggal Pembayaran</th>
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
                                                    <?= $value->no_invoice ?>
                                                </td>
                                                <td>
                                                    <?= $value->payment ?>
                                                </td>
                                                <td>
                                                    <?= $value->payment_method == 'C' ? $value->payment_type : $value->bank ?>
                                                </td>
                                                <td>
                                                    <?= $value->transaction_time ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($value->transaction_status == 'pending') {
                                                        echo "<span class='badge badge-warning'><i class='fas fa-clock'></i> Menunggu Pembayaran</span>";
                                                    } else if ($value->transaction_status == 'settlement') {
                                                        echo "<span class='badge badge-success'><i class='fas fa-check'></i> Sudah Terbayar</span>";
                                                    } else if ($value->transaction_status == 'expire') {
                                                        echo "<span class='badge badge-danger'><i class='fas fa-times'></i> Pembayaran Kadaluarsa</span>";
                                                    } else if ($value->transaction_status == 'cancel') {
                                                        echo "<span class='badge badge-danger'><i class='fas fa-times'></i> Pemesanan Dibatalkkan</span>";
                                                    } else {
                                                        "<span class='badge badge-success'><i class='fas fa-check'></i></span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="<?= site_url($url . '/detail_pembayaran/' .  $value->id_penyewaan_detail) ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                    <?php
                                                    if ($value->payment_method == 'C' && $value->last_transaction_status == 'pending') {
                                                    ?>
                                                        <button class="btn btn-success" id="btn<?= $key ?>" type="button" onclick="action(<?= $key ?>,<?= $value->id_penyewaan_detail ?>,'<?= '/' . $url . '/'  ?>','bayar_cod','<?= $alert ?>')"><i class="fas fa-money-bill"></i></button>
                                                    <?php
                                                    }
                                                    ?>
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