<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Kamar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
                <div class="breadcrumb-item">Kamar</div>
                <div class="breadcrumb-item">Tambah Data Kamar</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="<?= site_url('kamar') ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <div class="form-group">
                                    <label>Nomor Kamar</label>
                                    <input type="text" class="form-control <?= (validation_show_error('nomor_kamar')) ? 'is-invalid' : ''; ?>" name="nomor_kamar" value="<?= old('nomor_kamar') ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('nomor_kamar')) ? validation_show_error('nomor_kamar') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Harga Kamar</label>
                                    <input type="text" class="form-control currency <?= (validation_show_error('harga_kamar')) ? 'is-invalid' : ''; ?>" name=" harga_kamar" value="<?= old('harga_kamar') ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('harga_kamar')) ? validation_show_error('harga_kamar') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Fasilitas Kamar</label>
                                    <select class="form-control select2" multiple="multiple" name="id_fasilitas[]">
                                        <?php foreach ($fasilitas as $key => $value) : ?>
                                            <option value="<?= $value->id_fasilitas ?>"><?= $value->judul_fasilitas ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Status Kamar</label>
                                    <input type="text" class="form-control <?= (validation_show_error('status_kamar')) ? 'is-invalid' : ''; ?>" name="status_kamar" value="Tersedia" readonly>
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('status_kamar')) ? validation_show_error('status_kamar') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Keterangan Kamar</label>
                                    <textarea class="form-control <?= (validation_show_error('keterangan_kamar')) ? 'is-invalid' : ''; ?>" name="keterangan_kamar"><?= old('keterangan_kamar') ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('keterangan_kamar')) ? validation_show_error('keterangan_kamar') : ''; ?>
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