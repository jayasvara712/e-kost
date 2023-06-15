<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Data Tipe Kamar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
                <div class="breadcrumb-item">Data Tipe Kamar</div>
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
                            <h4 class="btn-group">
                                <a href="<?= site_url($url . "/new") ?>" class="btn btn-success btn-lg">
                                    <i class="fas fa-plus"></i> Tambah Data Kamar</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>Tipe Kamar</th>
                                            <th>Fasilitas Kamar</th>
                                            <th>Gambar Kamar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dataTipeKamar['tipeKamar'] as $key => $tipeKamar) : ?>
                                            <tr>
                                                <td>
                                                    <?= $tipeKamar['judul_tipe_kamar'] ?>
                                                </td>
                                                <td>
                                                    <?php foreach ($dataTipeKamar['fasilitas'] as $key => $fasilitas) : ?>
                                                        <?= $tipeKamar['id_tipe_kamar'] == $fasilitas['id_tipe_kamar'] ? $fasilitas['judul_fasilitas'] : '' ?>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td>
                                                    <div class="gallery">
                                                        <?php
                                                        $i = 0;
                                                        foreach ($dataTipeKamar['gambar'] as $key => $gambar) :
                                                            if ($tipeKamar['id_tipe_kamar'] == $gambar['id_tipe_kamar']) {
                                                                $i += 1;
                                                                if ($i < 3) {
                                                                    echo '
                                                                        <div class="gallery-item" data-image="../uploads/kamar/' . $gambar['image'] . '" data-title="image ' . $i . '"></div>
                                                                    ';
                                                                } else  if ($i == 3) {
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
                                                </td>
                                                <td>
                                                    <a href="<?= site_url($url . '/edit/' .  $tipeKamar['id_tipe_kamar']) ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-danger" id="btndelete<?= $key ?>" type="button" onclick="deleteData(<?= $key ?>,<?= $tipeKamar['id_tipe_kamar'] ?>,'<?= '/' . $url ?>','<?= $alert ?>')"><i class="fas fa-trash"></i></button>
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