<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Tipe Kamar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
                <div class="breadcrumb-item">Data Tipe Kamar</div>
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
                                    <label>Tipe Kamar</label>
                                    <input type="text" class="form-control <?= (validation_show_error('judul_tipe_kamar')) ? 'is-invalid' : ''; ?>" name=" judul_tipe_kamar" value="<?= old('judul_tipe_kamar') ?>" placeholder="Nama Tipe Kamar">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('judul_tipe_kamar')) ? validation_show_error('judul_tipe_kamar') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Fasilitas Kamar</label>
                                    <select class="form-control selectric <?= (validation_show_error('id_fasilitas')) ? 'is-invalid' : ''; ?>" multiple="multiple" name="id_fasilitas[]" value="<?= old('id_fasilitas[]') ?>">
                                        <option value="">Silahkan pilih fasilitas kamar</option>
                                        <?php foreach ($fasilitas as $key => $value) : ?>
                                            <option value="<?= $value->id_fasilitas ?>"><?= $value->judul_fasilitas ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('id_fasilitas')) ? validation_show_error('id_fasilitas') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Gambar</label>
                                    <div id="preview"></div>
                                    <input type="file" class="form-control <?= (validation_show_error('image')) ? 'is-invalid' : ''; ?>" id="browse" name="image[]" multiple onchange="previewFiles()" />
                                    <p>File Format PNG/JPG/JPEG/JFIF | Max Size 5mb</p>
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('image')) ? validation_show_error('image') : ''; ?>
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