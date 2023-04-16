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
                <div class="breadcrumb-item">Edit Data Kamar</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="<?= site_url('kamar/update/' . $kamar->id_kamar) ?>" method="post" autocomplete="off" enctype="multipart/form-data">

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Kamar</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="nomor_kamar" value="<?= $kamar->nomor_kamar ?>">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga Kamar</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" class="form-control" name="harga_kamar" value="<?= $kamar->harga_kamar ?>">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Fasilitas Kamar</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="id_fasilitas" value="<?= $kamar->id_fasilitas ?>">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status Kamar</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="status_kamar" value="<?= $kamar->status_kamar ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keterangan Kamar</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea class="form-control" name="keterangan_kamar"><?= $kamar->keterangan_kamar ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type=" submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                                        <button type="reset" class="btn btn-danger"><i class="fas fa-undo"></i> Reset</button>
                                    </div>
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