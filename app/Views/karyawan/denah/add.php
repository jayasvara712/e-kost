<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Denah</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Karyawan</a></div>
                <div class="breadcrumb-item">Data Denah</div>
                <div class="breadcrumb-item">Tambah</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="<?= site_url($url) ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <div class="form-group">
                                    <label>Judul Denah</label>
                                    <input type="text" class="form-control <?= (validation_show_error('judul_denah')) ? 'is-invalid' : ''; ?>" name=" judul_denah" value="<?= old('judul_denah') ?>" placeholder="Nama Tipe Kamar">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('judul_denah')) ? validation_show_error('judul_denah') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Gambar Denah</label>
                                    <br>
                                    <img src="/uploads/galeri/no-image.png" alt="" srcset="" class="image-thumbnail img-preview" width="150px" id="img-preview">
                                    <div class="col-sm-12 col-md-12">
                                        <input type="file" id="gambar" name="image_denah" class="form-control <?= (validation_show_error('image_denah')) ? 'is-invalid' : ''; ?>" onchange="imagePreview()">
                                        <div class="invalid-feedback">
                                            <?= (validation_show_error('image_denah')) ? validation_show_error('image_denah') : ''; ?>
                                        </div>
                                        <label for="gambar" class="custom-file-label gambar-label">Tambah Gambar</label>
                                        <p>File Format PNG/JPG/JPEG | Max Size 5mb</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi Denah</label>
                                    <input type="text" class="form-control <?= (validation_show_error('deskripsi_denah')) ? 'is-invalid' : ''; ?>" name=" deskripsi_denah" value="<?= old('deskripsi_denah') ?>" placeholder="Nama Tipe Kamar">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('deskripsi_denah')) ? validation_show_error('deskripsi_denah') : ''; ?>
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