<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Tiket</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Tiket</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">

                            <div class="tickets">
                                <div class="ticket-content">
                                    <?php
                                    foreach ($tiket_detail as $key => $value) {
                                    ?>
                                        <div class="ticket-header">

                                            <div class="ticket-detail">
                                                <div class="ticket-title">
                                                    <h4><?= $value->judul_tiket ?></h4>
                                                </div>
                                                <div class="ticket-info">
                                                    <div class="font-weight-600"><?= $value->user == 1 ? $value->nama_penghuni : $value->nama_karyawan ?></div>
                                                    <div class="bullet"></div>
                                                    <div class="text-primary font-weight-600"><?= $value->tgl_pesan ?></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="ticket-description">
                                            <p><?= $value->pesan ?></p>
                                        </div>

                                        <?php if ($value->gambar != '') { ?>
                                            <img src="<?= site_url('/uploads/tiket/' . $value->id_tiket . '/' . $value->gambar); ?>" height="200">
                                        <?php }; ?>

                                        <div class="ticket-divider"></div>
                                    <?php } ?>

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