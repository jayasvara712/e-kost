<?= $this->extend('library/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Data Kamar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
                <div class="breadcrumb-item">Kamar</div>
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
                            <p class="btn-group">
                                <a href="<?= site_url("kamar/new") ?>" class="btn btn-success btn-lg">
                                    <i class="fas fa-plus"></i> Tambah Data Kamar</a>
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-2">
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
                                        <?php foreach ($kamar as $key => $value) : ?>
                                            <tr>
                                                <td>
                                                    <?= $value->nomor_kamar ?>
                                                </td>
                                                <td>
                                                    <?= $value->harga_kamar ?>
                                                </td>
                                                <td>
                                                    <?= $value->id_fasilitas ?>
                                                </td>
                                                <td>
                                                    <?= $value->status_kamar ?>
                                                </td>
                                                <td>
                                                    <?= $value->keterangan_kamar ?>
                                                </td>
                                                <td>
                                                    <a href="<?= site_url('kamar/edit/' .  $value->id_kamar) ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                    <form action="<?= site_url('kamar/delete/') . $value->id_kamar ?>" class="d-inline" method="post">
                                                        <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
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