<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Kamar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Karyawan</a></div>
                <div class="breadcrumb-item">Kamar</div>
                <div class="breadcrumb-item">Edit Data Kamar</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="<?= site_url($url . '/update/' . $kamar->id_kamar) ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <div class="form-group">
                                    <label>Nomor Kamar</label>

                                    <input type="text" class="form-control" name="nomor_kamar" value="<?= $kamar->nomor_kamar ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Harga Kamar</label>

                                    <input type="text" class="form-control currency" name="harga_kamar" value="<?= $kamar->harga_kamar ?>">
                                </div>

                                <div class="form-group">
                                    <label>Fasilitas Kamar</label>
                                    <select class="form-control select2" multiple="multiple" name="id_fasilitas[]">
                                        <?php
                                        foreach ($fasilitas as $key1 => $fasilitas) :
                                            $i = 0;
                                            foreach ($temp_id_fasilitas as $key2 => $selected_fasilitas) :
                                                if ($selected_fasilitas->id_fasilitas == $fasilitas->id_fasilitas) {
                                                    echo '<option value="' . $fasilitas->id_fasilitas . '" selected>' . $fasilitas->judul_fasilitas . '</option>';
                                                    $i = 1;
                                                    break;
                                                }
                                            endforeach;
                                            if ($i == 0) {
                                                echo '<option value="' . $fasilitas->id_fasilitas . '">' . $fasilitas->judul_fasilitas . '</option>';
                                            }
                                        ?>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Status Kamar</label>

                                    <input type="text" class="form-control" name="status_kamar" value="<?= $kamar->status_kamar ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Keterangan Kamar</label>

                                    <textarea class="form-control" name="keterangan_kamar"><?= $kamar->keterangan_kamar ?></textarea>
                                </div>

                                <div class="form-group">
                                    <button type=" submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
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