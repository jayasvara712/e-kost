<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Kamar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Guest</a></div>
                <div class="breadcrumb-item">Kamar</div>
            </div>
        </div>

        <div class="section-body">
            <?php if (session()->getFlashdata('success')) : ?>
                <div id="success" style="visibility: hidden">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif ?>

            <form action="<?= site_url('penghuni/penyewaan') ?>" method="POST" autocomplete="off" enctype="multipart/form-data" id="sectionForm">
                <?= csrf_field() ?>

                <input type="hidden" name="id_kamar" id="id_kamar" class="id_kamar" value="">
                <input type="hidden" name="nomor_kamar" id="nomor_kamar" class="nomor_kamar" value="">
                <input type="hidden" class="form-control" name="id_penghuni" id="id_penghuni" value="<?= session('id_penghuni') ?>">
                <div class="row">

                    <?php
                    foreach ($dataKamar['kamar'] as $key => $kamar) :
                    ?>

                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="card <?= ($kamar['status_kamar'] == 'Tersedia') ? 'card-success' : 'card-danger' ?>">
                                <div class="card-header">
                                    <h4>Kamar <?= $kamar['nomor_kamar'] ?></h4>
                                    <div class="card-header-action">
                                        <a data-collapse="#kamar<?= $kamar['id_kamar'] ?>" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                    </div>
                                </div>
                                <div class="collapse <?= $kamar['status_kamar'] == 'Tersedia' ? 'show' : '' ?>" id="kamar<?= $kamar['id_kamar'] ?>">
                                    <div class="card-body">
                                        <h5>Fasilitas Kamar : </h5>
                                        <p>
                                            <?php foreach ($dataKamar['fasilitas'] as $key => $fasilitas) : ?>
                                                <?= $kamar['id_kamar'] == $fasilitas['id_kamar'] ? $fasilitas['judul_fasilitas'] : '' ?>
                                            <?php endforeach ?>
                                        </p>
                                        <h5>Keterangan : </h5>
                                        <p><?= $kamar['keterangan_kamar'] ?></p>
                                        <h5>Status : </h5>
                                        <p><?= $kamar['status_kamar'] ?></p>
                                        <h5>Harga Perbulan : </h5>
                                        <b><?= $kamar['harga_kamar'] ?></b>

                                        <br>
                                        <div class="gallery">
                                            <?php foreach ($dataKamar['gambar'] as $key => $gambar) : ?>
                                                <?= $kamar['id_kamar'] == $gambar['id_kamar'] ? '<div class="gallery-item" data-image = "uploads/kamar/' . $gambar['image'] . '"></div>' : '' ?>
                                            <?php endforeach ?>
                                        </div>
                                    </div>


                                    <div class="card-footer">
                                        <a href="<?= $kamar['status_kamar'] == 'Tersedia' ? 'login' : '#' ?>" class="btn btn-info"><i class="fas fa-cart-plus"></i> Pesan</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach ?>

                </div>
            </form>

        </div>
    </section>
</div>

<?= $this->endSection(); ?>