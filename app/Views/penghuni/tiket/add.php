<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Tiket</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Tiket</div>
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

                                <input type="hidden" class="form-control" name="id_penghuni" id="id_penghuni" value="<?= session('id_penghuni') ?>">
                                <input type="hidden" class="form-control" name="user" value="1">

                                <div class="form-group">
                                    <label>Judul Tiket</label>
                                    <input type="text" class="form-control <?= (validation_show_error('judul_tiket')) ? 'is-invalid' : ''; ?>"" name=" judul_tiket" value="<?= old('judul_tiket') ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('judul_tiket')) ? validation_show_error('judul_tiket') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Pesan</label>
                                    <textarea name="pesan" class="form-control <?= (validation_show_error('pesan')) ? 'is-invalid' : ''; ?>"><?= old('pesan') ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('pesan')) ? validation_show_error('pesan') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Gambar</label>
                                    <img src="/uploads/galeri/no-image.png" alt="" srcset="" class="image-thumbnail img-preview" width="150px">
                                    <div class="col-sm-12 col-md-12">
                                        <input type="file" id="gambar" name="gambar" class="form-control <?= (validation_show_error('gambar')) ? 'is-invalid' : ''; ?>" onchange="imagePreview()">
                                        <div class="invalid-feedback">
                                            <?= (validation_show_error('gambar')) ? validation_show_error('gambar') : ''; ?>
                                        </div>
                                        <label for="gambar" class="custom-file-label gambar-label">Tambah Gambar</label>
                                        <p>File Format PNG/JPG/JPEG | Max Size 5mb</p>
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