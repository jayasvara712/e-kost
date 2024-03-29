<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Fasilitas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
                <div class="breadcrumb-item">Data Fasilitas</div>
                <div class="breadcrumb-item">Tambah</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="<?= site_url($url) ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <div class="form-group">
                                    <label>Judul Fasilitas</label>
                                    <input type="text" class="form-control <?= (validation_show_error('judul_fasilitas')) ? 'is-invalid' : ''; ?>" name="judul_fasilitas" value="<?= old('judul_fasilitas') ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('judul_fasilitas')) ? validation_show_error('judul_fasilitas') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Icon Fasilitas</label>
                                    <p>Reference icon <a href="https://fontawesome.com/v5/search">Font Awesome.</a></p>
                                    <input type="text" class="form-control <?= (validation_show_error('icon_fasilitas')) ? 'is-invalid' : ''; ?>" name="icon_fasilitas" value="<?= old('icon_fasilitas') ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('icon_fasilitas')) ? validation_show_error('icon_fasilitas') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label></label>
                                    <button class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                                </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?= $this->endSection(); ?>