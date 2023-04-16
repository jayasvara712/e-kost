<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Fasilitas</h1>
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
                            <div class="alert alert-success alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">x</button>
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            </div>
                        <?php endif ?>

                        <div class="card-header">
                            <h4 class="btn-group">
                                <a href="<?= site_url("fasilitas/new") ?>" class="btn btn-success btn-lg">
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
                                                    <a href="<?= site_url('fasilitas/edit/' .  $value->id_fasilitas) ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                    <form action="<?= site_url('fasilitas/delete/') . $value->id_fasilitas ?>" class="d-inline" method="post">
                                                        <?= csrf_field() ?>
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