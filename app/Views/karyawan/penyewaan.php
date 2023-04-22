<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Data Penyewaan Kamar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Data Penyewaan</div>
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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-2">
                                    <thead>
                                        <tr>
                                            <th>No Invoice</th>
                                            <th>Tanggal</th>
                                            <th>Lama Sewa</th>
                                            <th>Payment Method</th>
                                            <th>Status</th>
                                            <th>Total Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($penyewaan as $key => $value) : ?>
                                            <tr>
                                                <td>
                                                    <?= $value->no_invoice ?>
                                                </td>
                                                <td>
                                                    <?= $value->tgl_penyewaan ?>
                                                </td>
                                                <td>
                                                    <?= $value->lama_penyewaan ?> Bulan
                                                </td>
                                                <td>
                                                    <?= ($value->payment_method == 'M') ? "<span class='badge badge-info'>Midtrans</span>" : "<span class='badge badge-success'>Cash</span>" ?>
                                                </td>
                                                <td>
                                                    <?php if ($value->payment_method == 'M') {
                                                        if ($value->transaction_status == 'pending') {
                                                            echo "<span class='badge badge-warning'><i class='fas fa-clock'></i></span>";
                                                        } else if ($value->transaction_status == 'settlement') {
                                                            echo "<span class='badge badge-success'><i class='fas fa-check'></i></span>";
                                                        } else {
                                                            echo "<span class='badge badge-danger'><i class='fas fa-times'></i></span>";
                                                        }
                                                    } else {
                                                        "<span class='badge badge-success'><i class='fas fa-check'></i></span>";
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?= $value->total_harga ?>
                                                </td>
                                                <td>
                                                    <a href="<?= site_url($url . '/show/' .  $value->id_penyewaan) ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
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