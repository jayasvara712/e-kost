<?= $this->extend('library/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Penyewaan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
                <div class="breadcrumb-item">Penyewaan</div>
                <div class="breadcrumb-item">Edit Data Penyewaan</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="<?= site_url('penyewaan/update/' . $penyewaan->id_penyewaan) ?>" method="POST" autocomplete="off" enctype="multipart/form-data">

                            <div class="card-body">

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Penghuni</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="id_penghuni" class="form-control">
                                            <?php foreach ($penghuni as $key => $value) : ?>
                                                <option value="<?= $value->id_penghuni ?>" <?php if ($value->id_penghuni == $penyewaan->id_penghuni) {
                                                                                                echo 'Selected';
                                                                                            } ?>><?= $value->nama_penghuni ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Kamar</label>
                                    <input type="hidden" name="old_id_kamar" value="<?= $penyewaan->id_kamar ?>">
                                    <div class="col-sm-12 col-md-7">
                                        <select name="id_kamar" class="form-control">
                                            <?php foreach ($kamar as $key => $value) : ?>
                                                <option value="<?= $value->id_kamar ?>" <?php if ($value->id_kamar == $penyewaan->id_kamar) {
                                                                                            echo 'Selected';
                                                                                        } ?>><?= $value->nomor_kamar . " | " . $value->status_kamar ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Penyewaan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="date" class="form-control" name="tgl_penyewaan" value="<?= $penyewaan->tgl_penyewaan ?>">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Lama Penyewaan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="lama_penyewaan" class="form-control">
                                            <option value="1" <?php if ($penyewaan->lama_penyewaan == '1') {
                                                                    echo 'Selected';
                                                                } ?>>1 Bulan</option>
                                            <option value="2" <?php if ($penyewaan->lama_penyewaan == '2') {
                                                                    echo 'Selected';
                                                                } ?>>2 Bulan</option>
                                            <option value="3" <?php if ($penyewaan->lama_penyewaan == '3') {
                                                                    echo 'Selected';
                                                                } ?>>3 Bulan</option>
                                            <option value="4" <?php if ($penyewaan->lama_penyewaan == '4') {
                                                                    echo 'Selected';
                                                                } ?>>4 Bulan</option>
                                            <option value="5" <?php if ($penyewaan->lama_penyewaan == '5') {
                                                                    echo 'Selected';
                                                                } ?>>5 Bulan</option>
                                            <option value="6" <?php if ($penyewaan->lama_penyewaan == '6') {
                                                                    echo 'Selected';
                                                                } ?>>6 Bulan</option>
                                            <option value="7" <?php if ($penyewaan->lama_penyewaan == '7') {
                                                                    echo 'Selected';
                                                                } ?>>7 Bulan</option>
                                            <option value="8" <?php if ($penyewaan->lama_penyewaan == '8') {
                                                                    echo 'Selected';
                                                                } ?>>8 Bulan</option>
                                            <option value="9" <?php if ($penyewaan->lama_penyewaan == '9') {
                                                                    echo 'Selected';
                                                                } ?>>9 Bulan</option>
                                            <option value="10" <?php if ($penyewaan->lama_penyewaan == '10') {
                                                                    echo 'Selected';
                                                                } ?>>10 Bulan</option>
                                            <option value="11" <?php if ($penyewaan->lama_penyewaan == '11') {
                                                                    echo 'Selected';
                                                                } ?>>11 Bulan</option>
                                            <option value="12" <?php if ($penyewaan->lama_penyewaan == '12') {
                                                                    echo 'Selected';
                                                                } ?>>12 Bulan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status Penyewaan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="status_penyewaan" value="<?= $penyewaan->status_penyewaan ?>" readonly>
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