<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Data Fasilitas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
                <div class="breadcrumb-item">Data Fasilitas</div>
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
                                    <i class="fas fa-plus"></i> Tambah Data Fasilitas</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Fasilitas</th>
                                            <th>Icon Fasilitas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($fasilitas as $key => $value) : ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td>
                                                    <?= $value->judul_fasilitas ?>
                                                </td>
                                                <td>
                                                    <?= $value->icon_fasilitas ?>
                                                </td>
                                                <td>
                                                    <a href="<?= site_url($url . '/edit/' .  $value->id_fasilitas) ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-danger" id="btndelete<?= $key ?>" type="button" onclick="deleteData(<?= $key ?>,<?= $value->id_fasilitas ?>,'<?= '/' . $url ?>','<?= $alert ?>')"><i class="fas fa-trash"></i></button>
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