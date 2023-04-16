<?= $this->extend('library/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Penyewaan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
                <div class="breadcrumb-item">Penyewaan</div>
                <div class="breadcrumb-item">Tambah Data Penyewaan</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="<?= site_url('penyewaan') ?>" method="POST" autocomplete="off" enctype="multipart/form-data">

                            <div class="card-body">

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Penghuni</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="id_penghuni" class="form-control">
                                            <?php foreach ($penghuni as $key => $value) : ?>
                                                <option value="<?= $value->id_penghuni ?>"><?= $value->nama_penghuni ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Kamar</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="id_kamar" class="form-control">
                                            <?php foreach ($kamar as $key => $value) : ?>
                                                <option value="<?= $value->id_kamar ?>"><?= $value->nomor_kamar . " | " . $value->status_kamar ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Penyewaan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="date" class="form-control" name="tgl_penyewaan">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Lama Penyewaan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="lama_penyewaan" class="form-control">
                                            <option value="1">1 Bulan</option>
                                            <option value="2">2 Bulan</option>
                                            <option value="3">3 Bulan</option>
                                            <option value="4">4 Bulan</option>
                                            <option value="5">5 Bulan</option>
                                            <option value="6">6 Bulan</option>
                                            <option value="7">7 Bulan</option>
                                            <option value="8">8 Bulan</option>
                                            <option value="9">9 Bulan</option>
                                            <option value="10">10 Bulan</option>
                                            <option value="11">11 Bulan</option>
                                            <option value="12">12 Bulan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status Penyewaan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="status_penyewaan" value="Tidak Aktif" readonly>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
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