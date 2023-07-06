<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Denah</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
                <div class="breadcrumb-item">Data Denah</div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="<?= site_url($url . '/update/' . $denah->id_denah) ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <input type="hidden" name="id_denah" value="<?= $denah->id_denah ?>">
                                <input type="hidden" name="image_denah_lama" value="<?= $denah->image_denah ?>">

                                <div class="form-group">
                                    <label>Judul Denah</label>

                                    <input type="text" class="form-control" name="judul_denah" value="<?= $denah->judul_denah ?>">
                                </div>

                                <div class="form-group">
                                    <label>Gambar Denah</label>
                                    <br>
                                    <img src="/uploads/denah/<?= $denah->image_denah ?>" alt="" srcset="" class="image-thumbnail img-preview" width="150px" id="img-preview">
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

                                    <input type="text" class="form-control" name="deskripsi_denah" value="<?= $denah->deskripsi_denah ?>">
                                </div>

                                <div class="form-group">
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