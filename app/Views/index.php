<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Kamar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <input type="hidden" id="csrfName" value="<?= csrf_token() ?>">
                    <input type="hidden" id="csrfHash" value="<?= csrf_hash() ?>">
                    <select name="" id="lantai_kamar" class="form-control selectric" onchange="select_lantai()">
                        <option value="">Silahkan Pilih lantai</option>
                        <option value="1">Lantai 1</option>
                        <option value="2">Lantai 2</option>
                        <option value="3">Lantai 3</option>
                    </select>
                </div>
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

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <article class="article article-style-b">
                                <div class="article-header">

                                    <div class="article-image" data-background="">
                                        <div class=" gallery gallery-fw" data-item-height="200">
                                            <?php
                                            $i = 0;
                                            foreach ($dataKamar['gambar'] as $key => $gambar) :
                                                if ($kamar['id_tipe_kamar'] == $gambar['id_tipe_kamar']) {
                                                    $i += 1;
                                                    if ($i < 1) {
                                                        echo '
                                                    <div class="gallery-item" data-image="../uploads/kamar/' . $gambar['image'] . '" data-title="image ' . $i . '"></div>
                                                ';
                                                    } else  if ($i == 1) {
                                                        echo '
                                                    <div class="gallery-item gallery-more" data-image="../uploads/kamar/' . $gambar['image'] . '" data-title="image ' . $i . '">
                                                        <div>+</div>
                                                    </div>
                                                ';
                                                    } else {
                                                        echo '
                                                    <div class="gallery-item gallery-hide" data-image="../uploads/kamar/' . $gambar['image'] . '" data-title="image ' . $i . '"></div>
                                                ';
                                                    }
                                                }
                                            endforeach;
                                            ?>
                                        </div>
                                    </div>

                                    <div class="article-badge">
                                        <?php if ($kamar['status_kamar'] == 'Tersedia') { ?>
                                            <div class="article-badge-item bg-success"><i class="fas fa-check"></i> Tersedia</div>
                                        <?php } else { ?>
                                            <div class="article-badge-item bg-danger"><i class="fas fa-times"></i> Penuh</div>
                                        <?php }; ?>
                                    </div>

                                </div>
                                <div class="article-details">
                                    <div class="article-title">
                                        <h3>No : <?= $kamar['nomor_kamar'] ?></h3>
                                    </div>
                                    <p>
                                        <?php foreach ($dataKamar['fasilitas'] as $key => $fasilitas) : ?>
                                            <?= $kamar['id_kamar'] == $fasilitas['id_kamar'] ? $fasilitas['judul_fasilitas'] . ',' : '' ?>
                                        <?php endforeach ?>
                                    </p>
                                    <?= $kamar['keterangan_kamar'] != null ? $kamar['keterangan_kamar'] : '' ?>
                                    <h5>
                                        <?= $kamar['harga_kamar'] ?>
                                    </h5>
                                    <div class="article-cta">
                                        <button class="btn btn-info" type="button" id="nextBtn" onclick="nextPrev(1,<?= $kamar['id_kamar'] ?>, <?= $kamar['harga_kamar'] ?>, <?= $kamar['nomor_kamar'] ?>)" <?= ($kamar['status_kamar'] == 'Tidak Tersedia') ? 'disabled' : '' ?>><i class="fas fa-cart-plus"></i> Pesan</button>
                                    </div>
                                </div>
                            </article>
                        </div>

                    <?php endforeach ?>

                </div>
            </form>

        </div>
    </section>
</div>

<?= $this->endSection(); ?>