<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Data Kamar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Karyawan</a></div>
                <div class="breadcrumb-item">Data Kamar</div>
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
                                            <th>No Kamar</th>
                                            <th>Harga Kamar</th>
                                            <th>Fasilitas Kamar</th>
                                            <th>Status Kamar</th>
                                            <th>Keterangan Kamar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dataKamar['kamar'] as $key => $kamar) : ?>
                                            <tr>
                                                <td>
                                                    <?= $kamar['nomor_kamar'] ?>
                                                </td>
                                                <td>
                                                    <?= $kamar['harga_kamar'] ?>
                                                </td>
                                                <td>
                                                    <?php foreach ($dataKamar['fasilitas'] as $key => $fasilitas) : ?>
                                                        <?= $kamar['id_kamar'] == $fasilitas['id_kamar'] ? $fasilitas['judul_fasilitas'] . ',' : '' ?>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td>
                                                    <?= $kamar['status_kamar'] ?>
                                                </td>
                                                <td>
                                                    <?= $kamar['keterangan_kamar'] ?>
                                                </td>
                                                <td>
                                                    <a href="<?= site_url($url . '/edit/' .  $kamar['id_kamar']) ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-danger" id="btndelete<?= $key ?>" type="button" onclick="deleteData(<?= $key ?>,<?= $kamar['id_kamar'] ?>,'<?= '/' . $url ?>','<?= $alert ?>')"><i class="fas fa-trash"></i></button>
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