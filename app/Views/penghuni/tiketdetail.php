<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Komplain</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Komplain</a></div>
                <div class="breadcrumb-item"><?= $judul_tiket ?></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">


                            <div class="tickets">
                                <div class="ticket-content">

                                    <?php foreach ($tiket_detail as $key => $value) : ?>
                                        <div class="ticket-header">
                                            <div class="ticket-detail">
                                                <div class="ticket-title">
                                                    <h4><?= $value->user == 1 ? $value->nama_penghuni : $value->nama_karyawan ?></h4>
                                                </div>
                                                <div class="ticket-info">
                                                    <div class="text-primary font-weight-600"><?= $value->tgl_pesan ?></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="ticket-description">
                                            <p><?= $value->pesan ?></p>

                                            <?php if ($value->gambar != '' || $value->gambar != null) : ?>
                                                <div class="gallery">
                                                    <div class="gallery-item" data-image="<?= base_url() . '/uploads/tiket/' . $value->id_tiket . '/' . $value->gambar ?>"></div>
                                                </div>
                                            <?php endif ?>

                                            <div class="ticket-divider"></div>
                                        </div>

                                    <?php endforeach ?>
                                </div>
                            </div>

                            <?php if ($status_tiket != 'done') : ?>
                                <div class="ticket-form">
                                    <form action="<?= site_url($url . '/update/' . $id_tiket) ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                                        <?= csrf_field() ?>
                                        <label for="">Reply</label>
                                        <input type="hidden" name="id_tiket" value="<?= $value->id_tiket ?>">
                                        <input type="hidden" name="user" value="1">

                                        <div class="form-group">
                                            <textarea class="form-control <?= (validation_show_error('pesan')) ? 'is-invalid' : ''; ?>" placeholder="Type a reply ..." name="pesan"></textarea>
                                            <div class="invalid-feedback">
                                                <?= (validation_show_error('pesan')) ? validation_show_error('pesan') : ''; ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <img src="#" alt="" srcset="" class="image-thumbnail img-preview" width="150px">
                                            <div class="col-sm-12 col-md-12">
                                                <input type="file" id="gambar" name="gambar" class="form-control <?= (validation_show_error('gambar')) ? 'is-invalid' : ''; ?>" onchange="imagePreview()">
                                                <div class="invalid-feedback">
                                                    <?= (validation_show_error('gambar')) ? validation_show_error('gambar') : ''; ?>
                                                </div>
                                                <label for="gambar" class="custom-file-label gambar-label">Tambah Gambar</label>
                                                <p>File Format PNG/JPG/JPEG | Max Size 5mb</p>
                                            </div>
                                        </div>

                                        <div class="form-group text-right">
                                            <button class="btn btn-primary btn-lg">
                                                Reply
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            <?php endif ?>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?= $this->endSection(); ?>