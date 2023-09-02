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
                <div class="card-header">
                    <!-- filter -->
                    <div class="buttons">
                        <form action="<?= site_url('/penghuni') ?>" method="POST" style="display: inline-block;">
                            <?= csrf_field() ?>
                            <input type="hidden" name="lantai_kamar" value="">
                            <button class="<?= $lantai == '' ? 'btn btn-success' : 'btn btn-outline-success' ?>">Semua Lantai</button>
                        </form>
                        <form action="<?= site_url('/penghuni') ?>" method="POST" style="display: inline-block;">
                            <?= csrf_field() ?>
                            <input type="hidden" name="lantai_kamar" value="1">
                            <button class="<?= $lantai == '1' ? 'btn btn-success' : 'btn btn-outline-success' ?>">Lantai 1</button>

                        </form>
                        <form action="<?= site_url('/penghuni') ?>" method="POST" style="display: inline-block;">
                            <?= csrf_field() ?>
                            <input type="hidden" name="lantai_kamar" value="2">
                            <button class="<?= $lantai == '2' ? 'btn btn-success' : 'btn btn-outline-success' ?>">Lantai 2</button>
                        </form>
                        <form action="<?= site_url('/penghuni') ?>" method="POST" style="display: inline-block;">
                            <?= csrf_field() ?>
                            <input type="hidden" name="lantai_kamar" value="3">
                            <button class="<?= $lantai == '3' ? 'btn btn-success' : 'btn btn-outline-success' ?>">Lantai 3</button>
                        </form>
                    </div>

                </div>
                <div class="card-body">
                    <?php
                    foreach ($dataKamar['kamar'] as $key => $kamar) :
                        $firstImage = null;
                    ?>
                        <ul class="list-unstyled">
                            <li class="media">
                                <?php
                                // Perulangan untuk mencari gambar pertama berdasarkan ID kamar
                                foreach ($dataKamar['gambar'] as $key => $gambar) :
                                    if ($kamar['id_tipe_kamar'] == $gambar['id_tipe_kamar']) {
                                        $firstImage = $gambar['image'];
                                        break; // Hentikan perulangan setelah menemukan gambar pertama
                                    }
                                endforeach;

                                // Menampilkan gambar pertama jika ada
                                if ($firstImage) {
                                    echo '
                                        <div class="col-lg-3">
                                        <picture>
                                            <img src="../uploads/kamar/' . $firstImage . '" class="img-fluid img-thumbnail" alt="..." style="object-fit: cover; height:200px" >
                                        </picture>
                                        </div>
                                        ';
                                } else {
                                    echo 'Gambar tidak tersedia'; // Tampilkan pesan jika tidak ada gambar
                                }
                                ?>
                                <div class="media-body col-lg-9">
                                    <h5 class="mt-0 mb-1"> Kamar No. <?= $kamar['nomor_kamar'] ?></h5>
                                    <p>
                                        <?php foreach ($dataKamar['fasilitas'] as $key => $fasilitas) : ?>
                                            <?= $kamar['id_kamar'] == $fasilitas['id_kamar'] ? $fasilitas['judul_fasilitas'] . ',' : '' ?>
                                        <?php endforeach ?>
                                    </p>
                                    <p>
                                        <?php
                                        $originalText = $kamar['keterangan_kamar'];

                                        // Define the maximum number of characters you want to display
                                        $maxCharacters = 20; // Change this to your desired limit

                                        // Check if the length of the original text exceeds the maximum
                                        if (strlen($originalText) > $maxCharacters) {
                                            // If it does, truncate the text and add "..." to indicate it's truncated
                                            $outputText = substr($originalText, 0, $maxCharacters) . '...';
                                        } else {
                                            // If it doesn't exceed the limit, use the original text as is
                                            $outputText = $originalText;
                                        }

                                        // Output the limited text
                                        echo $outputText;
                                        ?>
                                    </p>
                                    <button class="<?= $kamar['status_kamar'] == 'Tersedia' ? 'btn btn-outline-success' : 'btn btn-outline-danger' ?>"><?= $kamar['status_kamar'] ?></button>
                                    <h5 class="text-right">Rp.<?= number_format($kamar['harga_kamar'], 0, ',', '.') ?> / Bulan</h5>
                                    <div class="float-right">
                                        <a href="<?= base_url() ?>/penghuni/kamar_detail/<?= $kamar['id_kamar'] ?>" class="btn btn-info">Lihat Kamar <i class="fas fa-arrow-alt-circle-right"></i></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    <?php
                    endforeach
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>