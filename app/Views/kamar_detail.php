<?= $this->extend('layout/template_penghuni'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">

        <div class="section-body">

            <!-- alert -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div id="success" style="visibility: hidden">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif ?>

            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <!-- detail kos -->
                        <div class="col-lg-7">
                            <article class="article article-style-b">
                                <div class="article-header">

                                    <!-- foto kostan -->
                                    <div class="article-image">
                                        <div class=" gallery gallery-fw" data-item-height="450">
                                            <?php
                                            $i = 0;
                                            foreach ($gambar as $key => $gambar) :
                                                if ($kamar['id_tipe_kamar'] == $gambar['id_tipe_kamar']) {
                                                    $i += 1;
                                                    if ($i < 1) {
                                                        echo '
                                                    <div class="gallery-item" data-image="../uploads/kamar/' . $gambar['image'] . '" data-title="image ' . $i . '"></div>
                                                ';
                                                    } else  if ($i == 1) {
                                                        echo '
                                                    <div class="gallery-item" data-image="../uploads/kamar/' . $gambar['image'] . '" data-title="image ' . $i . '">
                                                        <div>+</div>
                                                    </div>
                                                ';
                                                    } else {
                                                        echo '
                                                    <div class="gallery-item" data-image="../uploads/kamar/' . $gambar['image'] . '" data-title="image ' . $i . '"></div>
                                                ';
                                                    }
                                                }
                                            endforeach;
                                            ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="article-details">
                                    <div class="article-title">
                                        <h4>Kamar No <?= $kamar['nomor_kamar'] ?></h4>
                                    </div>

                                    <hr>

                                    <?php
                                    if ($kamar['keterangan_kamar'] != '') {
                                    ?>
                                        <h4>Keterangan Kamar</h4>
                                        <h6>
                                            <?= $kamar['keterangan_kamar'] ?>
                                        </h6>
                                    <?php
                                    }
                                    ?>
                                    <h4>Fasilitas Kamar</h4>
                                    <ul class="list-unstyled">
                                        <?php foreach ($fasilitas as $key => $fasilitas) : ?>
                                            <li class="media">
                                                <?= $kamar['id_kamar'] == $fasilitas['id_kamar'] ? $fasilitas['icon_fasilitas'] : '' ?>
                                                <div class="media-body">
                                                    <h6 class="mt-0 mb-1 ml-3"><?= $kamar['id_kamar'] == $fasilitas['id_kamar'] ? $fasilitas['judul_fasilitas'] : '' ?></h6>
                                                </div>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                    <hr>

                                    <!-- rule -->
                                    <h4>Peraturan <?= getenv('judul_web') ?></h4>
                                    <h6><i class="fas fa-history"></i> Akses 24 Jam</h6>
                                    <h6><i class="fas fa-smoking-ban"></i> Dilarang merokok di kamar</h6>
                                    <h6><i class="far fa-times-circle"></i> Lawan jenis dilarang ke kamar</h6>
                                </div>
                            </article>
                        </div>

                        <!-- pemesanan -->
                        <div class="col-lg-5">
                            <h4 class="text-center">Detail Harga Kamar</h4>
                            <h5 class="text-right">Rp.<?= number_format($kamar['harga_kamar'], 0, ',', '.') ?> / Bulan</h5>
                            <br>
                            <form action="<?= site_url('temp_sewa') ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <input type="hidden" name="id_kamar" id="id_kamar" value="<?= $kamar['id_kamar'] ?>">
                                <input type="hidden" name="nomor_kamar" id="nomor_kamar" value="<?= $kamar['nomor_kamar'] ?>">
                                <input type="hidden" name="harga_kamar" id="harga_kamar" value="<?= $kamar['harga_kamar'] ?>">

                                <!-- form input -->
                                <div class="row">

                                    <!-- tgl penyewaaan -->
                                    <div class="form-group col-lg-6">
                                        <input type="date" class="form-control" name="tgl_penyewaan" id="tgl_penyewaan" value="<?= date('Y-m-d') ?>">
                                    </div>

                                    <br>
                                    <!-- lama penyewaan -->
                                    <div class="form-group col-lg-6">
                                        <select name="lama_penyewaan" class="form-control" id="lama_penyewaan" onchange="countRangeDate()">
                                            <option value=""> Pilih Lama Penyewaan</option>
                                            <?php for ($i = 1; $i <= 12; $i++) { ?>
                                                <option value="<?= $i ?>" <?= ($i == old('lama_penyewaan')) ? 'selected' : '' ?>><?= $i ?> Bulan</option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- metode pembayaran -->
                                    <div class=" form-group col-lg-12">
                                        <select name="payment_method" class="form-control" id="payment_method">
                                            <option value=""> Pilih Metode Pembayaran</option>
                                            <option value="C" <?= ('C' == old('lama_penyewaan')) ? 'selected' : '' ?>>Cash</option>
                                            <option value="M" <?= ('M' == old('lama_penyewaan')) ? 'selected' : '' ?>>Online</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label">Tanggal Berakhir</label>
                                            <input type="date" class="form-control" id="tanggal_berakhir" readonly>
                                    </div>

                                    <div class=" form-group col-lg-12">
                                        <label">Total Harga</label>
                                            <input type="text" class="form-control" name="total_harga" id="total_harga" readonly>
                                    </div>

                                </div>

                                <button class="btn btn-info" <?= ($kamar['status_kamar'] == 'Tidak Tersedia') ? 'disabled' : '' ?>><i class="fas fa-cart-plus"></i> Pesan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>