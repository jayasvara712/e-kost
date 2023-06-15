<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Kamar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
                <div class="breadcrumb-item">Data Kamar</div>
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
                                    <label>Nomor Kamar</label>
                                    <input type="text" class="form-control <?= (validation_show_error('nomor_kamar')) ? 'is-invalid' : ''; ?>" name=" nomor_kamar" value="<?= old('nomor_kamar') ?>" placeholder="0x">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('nomor_kamar')) ? validation_show_error('nomor_kamar') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Harga Kamar</label>
                                    <input type="text" class="form-control currency <?= (validation_show_error('harga_kamar')) ? 'is-invalid' : ''; ?>" name=" harga_kamar" value="<?= old('harga_kamar') ?>" placeholder="1.000.000">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('harga_kamar')) ? validation_show_error('harga_kamar') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Tipe Kamar</label>
                                    <select class="form-control selectric <?= (validation_show_error('id_tipe_kamar')) ? 'is-invalid' : ''; ?>" name="id_tipe_kamar">
                                        <option value="">Silahkan pilih tipe kamar</option>
                                        <?php foreach ($tipe_kamar as $key => $value) : ?>
                                            <option value="<?= $value->id_tipe_kamar ?>"><?= $value->judul_tipe_kamar ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('id_tipe_kamar')) ? validation_show_error('id_tipe_kamar') : ''; ?>
                                    </div>
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