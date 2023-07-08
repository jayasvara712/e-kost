<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Kamar</h1>
            <form action="<?= site_url('/') ?>" method="POST" autocomplete="off" enctype="multipart/form-data" id="sectionForm">
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">
                        <?= csrf_field() ?>
                        <select name="lantai_kamar" class="form-control selectric">
                            <option value="">Silahkan Pilih lantai</option>
                            <option value="1">Lantai 1</option>
                            <option value="2">Lantai 2</option>
                            <option value="3">Lantai 3</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-info"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>

        <div class="section-body">

            <?php if (session()->getFlashdata('success')) : ?>
                <div id="success" style="visibility: hidden">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif ?>

            <div class="row">

                <?php
                foreach ($dataKamar['kamar'] as $key => $kamar) :
                ?>

                    <?= csrf_field() ?>

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
                                    <form action="<?= site_url('penghuni/penyewaan') ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                                        <?= csrf_field() ?>
                                        <?php
                                        $params = [
                                            'id_kamar'          => $kamar['id_kamar'],
                                            'current_tab'          => 1,
                                            'harga_kamar'       => $kamar['harga_kamar'],
                                            'nomor_kamar'       => $kamar['nomor_kamar'],
                                        ];
                                        session()->set($params);
                                        ?>

                                        <button class="btn btn-info" <?= ($kamar['status_kamar'] == 'Tidak Tersedia') ? 'disabled' : '' ?>><i class="fas fa-cart-plus"></i> Pesan</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    </div>

                <?php endforeach ?>

            </div>

        </div>
    </section>
</div>

<?= $this->endSection(); ?>