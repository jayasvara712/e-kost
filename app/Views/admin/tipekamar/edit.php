<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Tipe Kamar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
                <div class="breadcrumb-item">Data Tipe Kamar</div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="<?= site_url($url . '/update/' . $tipe_kamar->id_tipe_kamar) ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <input type="hidden" name="id_tipe_kamar" value="<?= $tipe_kamar->id_tipe_kamar ?>">

                                <div class="form-group">
                                    <label>Judul Tipe Kamar</label>

                                    <input type="text" class="form-control" name="judul_tipe_kamar" value="<?= $tipe_kamar->judul_tipe_kamar ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Fasilitas Kamar</label>
                                    <select class="form-control selectric" multiple="multiple" name="id_fasilitas[]">
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
                                    <label>Gambar</label>
                                    <input type="hidden" name="gambar_lama[]" value="<?= $temp_image ?>" id="old-image">
                                    <input type="hidden" name="array_image" id="array_image">

                                    <div class="row" id="old_preview">
                                    </div>
                                    <div id="preview">
                                    </div>

                                    <input type="file" class="form-control <?= (validation_show_error('image')) ? 'is-invalid' : ''; ?>" id="browse" name="image[]" multiple onchange="autoPreviewFiles()" />
                                    <p>File Format PNG/JPG/JPEG/JFIF | Max Size 5mb</p>
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('image')) ? validation_show_error('image') : ''; ?>
                                    </div>
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