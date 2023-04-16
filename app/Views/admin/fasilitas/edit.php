<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Fasilitas</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
                <div class="breadcrumb-item">Fasilitas</div>
                <div class="breadcrumb-item">Edit Data Fasilitas</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="<?= site_url('fasilitas/update/' . $fasilitas->id_fasilitas) ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <div class="form-group">
                                    <label>Judul Fasilitas</label>
                                    <input type="text" class="form-control <?= (validation_show_error('judul_fasilitas')) ? 'is-invalid' : ''; ?>"" name=" judul_fasilitas" value="<?= $fasilitas->judul_fasilitas ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('judul_fasilitas')) ? validation_show_error('judul_fasilitas') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label></label>
                                    <button type=" submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                                    <button type="reset" class="btn btn-danger"><i class="fas fa-undo"></i> Reset</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?= $this->endSection(); ?>