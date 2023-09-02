<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Kamar</h1>
            <form action="<?= site_url('/penghuni') ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">
                        <?= csrf_field() ?>
                        <select name="lantai_kamar" class="form-control selectric">
                            <option value="">Silahkan pilih lantai kamar</option>
                            <option value="1" <?= '1' == old('lantai_kamar') ? 'selected' : '' ?>>Lantai 1</option>
                            <option value="2" <?= '2' == old('lantai_kamar') ? 'selected' : '' ?>>Lantai 2</option>
                            <option value="3" <?= '3' == old('lantai_kamar') ? 'selected' : '' ?>>Lantai 3</option>
                            <option value="4" <?= '4' == old('lantai_kamar') ? 'selected' : '' ?>>Lantai 4</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-info"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Penyewa</a></div>
                <div class="breadcrumb-item">Kamar</div>
            </div>
        </div>

        <div class="section-body">

            <?php if (session()->getFlashdata('success')) : ?>
                <div id="success" style="visibility: hidden">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif ?>

            <form action="<?= site_url('penghuni/penyewaan') ?>" method="POST" autocomplete="off" enctype="multipart/form-data" id="sectionForm">
                <?= csrf_field() ?>

                <div class="tab">

                    <input type="hidden" name="current_tab" id="current_tab" class="current_tab" value="<?= (isset($dataTemp['current_tab'])) ? $dataTemp['current_tab'] : 0 ?>">
                    <input type="hidden" name="id_kamar" id="id_kamar" class="id_kamar" value="<?= (isset($dataTemp['id_kamar'])) ? $dataTemp['id_kamar'] : '' ?>">
                    <input type="hidden" name="nomor_kamar" id="nomor_kamar" class="nomor_kamar" value="<?= (isset($dataTemp['nomor_kamar'])) ? $dataTemp['nomor_kamar'] : '' ?>">
                    <input type="hidden" name="id_penghuni" id="id_penghuni" value="<?= session('id_penghuni') ?>">

                    <div class="row">

                        <?php
                        foreach ($dataKamar['kamar'] as $key => $kamar) :
                        ?>

                            <div class="col-12 col-sm-6 col-lg-6">
                                <article class="article article-style-b">
                                    <div class="article-header">

                                        <div class="article-image" data-background="">
                                            <div class=" gallery gallery-fw" data-item-height="200">
                                                <?php
                                                $i = 0;
                                                foreach ($dataKamar['gambar'] as $key => $gambar) :
                                                    if ($kamar['id_tipe_kamar'] == $gambar['id_tipe_kamar']) {
                                                        $i += 1;
                                                        if ($i < 1) {
                                                            echo '
                                                    <div class="gallery-item" data-image="../uploads/kamar/' . $gambar['image'] . '" data-title="image ' . $i . '"></div>
                                                ';
                                                        } else  if ($i == 1) {
                                                            echo '
                                                    <div class="gallery-item gallery-more" data-image="../uploads/kamar/' . $gambar['image'] . '" data-title="image ' . $i . '">
                                                        <div>+</div>
                                                    </div>
                                                ';
                                                        } else {
                                                            echo '
                                                    <div class="gallery-item gallery-hide" data-image="../uploads/kamar/' . $gambar['image'] . '" data-title="image ' . $i . '"></div>
                                                ';
                                                        }
                                                    }
                                                endforeach;
                                                ?>
                                            </div>
                                        </div>

                                        <div class="article-badge">
                                            <?php if ($kamar['status_kamar'] == 'Tersedia') { ?>
                                                <div class="article-badge-item bg-success"><i class="fas fa-check"></i> Tersedia</div>
                                            <?php } else { ?>
                                                <div class="article-badge-item bg-danger"><i class="fas fa-times"></i> Penuh</div>
                                            <?php }; ?>
                                        </div>

                                    </div>
                                    <div class="article-details">
                                        <div class="article-title">
                                            <h3>No : <?= $kamar['nomor_kamar'] ?></h3>
                                        </div>
                                        <p>
                                            <?php foreach ($dataKamar['fasilitas'] as $key => $fasilitas) : ?>
                                                <?= $kamar['id_kamar'] == $fasilitas['id_kamar'] ? $fasilitas['judul_fasilitas'] . ',' : '' ?>
                                            <?php endforeach ?>
                                        </p>
                                        <?= $kamar['keterangan_kamar'] != null ? $kamar['keterangan_kamar'] : '' ?>
                                        <h5>
                                            <?= $kamar['harga_kamar'] ?>
                                        </h5>
                                        <div class="article-cta">
                                            <button class="btn btn-info" type="button" id="nextBtn" onclick="nextPrev(1,<?= $kamar['id_kamar'] ?>, <?= $kamar['harga_kamar'] ?>, <?= $kamar['nomor_kamar'] ?>)" <?= ($kamar['status_kamar'] == 'Tidak Tersedia') ? 'disabled' : '' ?>><i class="fas fa-cart-plus"></i> Pesan</button>
                                        </div>
                                    </div>
                                </article>
                            </div>

                        <?php endforeach ?>

                    </div>
                </div>

                <div class="tab">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No Invoice</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="no_invoice" id="no_invoice" value="<?= $no_invoice ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Penyewaan</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="date" class="form-control" name="tgl_penyewaan" id="tgl_penyewaan" value="<?= date('Y-m-d') ?>">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga Kamar</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="harga_kamar" id="harga_kamar" value="<?= (isset($dataTemp['harga_kamar'])) ? $dataTemp['harga_kamar'] : '' ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Lama Penyewaan</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="lama_penyewaan" class="form-control" id="lama_penyewaan" onchange="countRangeDate()">
                                        <option value=""> Pilih Lama Penyewaan</option>
                                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                                            <option value="<?= $i ?>" <?= ($i == old('lama_penyewaan')) ? 'selected' : '' ?>><?= $i ?> Bulan</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Berakhir</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="date" class="form-control" id="tanggal_berakhir" readonly>
                                </div>
                            </div>

                            <div class=" form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Total Harga</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="total_harga" id="total_harga" readonly>
                                </div>
                            </div>

                            <div class=" form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Metode Pembayaran</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="payment_method" class="form-control" id="payment_method">
                                        <option value=""> Pilih Metode Pembayaran</option>
                                        <option value="C" <?= ('C' == old('lama_penyewaan')) ? 'selected' : '' ?>>Cash</option>
                                        <option value="M" <?= ('M' == old('lama_penyewaan')) ? 'selected' : '' ?>>Online</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-4 content-section">
                            </div>

                            <button class="btn btn-primary" type="button" id="prevBtn" onclick="nextPrev(0)">Previous</button>
                            <button class="btn btn-primary" id="saveBtn">Sewa</button>
                        </div>
                    </div>
                </div>

                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                </div>
            </form>

        </div>
    </section>
</div>

<script>
    let currentTab = document.getElementById('current_tab').value; // Current tab is set to be the first tab (0)
    if (currentTab == 1) {
        showTab(currentTab); // Display the current tab
    } else {
        showTab(currentTab);
    }

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
            document.getElementById("nextBtn").style.display = "inline";
            document.getElementById("saveBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
            document.getElementById("nextBtn").style.display = "none";
            document.getElementById("saveBtn").style.display = "inline";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n, val, harga, no_kmr) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        var id_kamar = document.getElementById("id_kamar");
        var harga_kamar = document.getElementById("harga_kamar");
        var nomor_kamar = document.getElementById("nomor_kamar");
        id_kamar.value = val;
        harga_kamar.value = harga;
        nomor_kamar.value = no_kmr;
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = n;
        console.log(currentTab);
        // if you have reached the end of the form...
        if (currentTab > x.length) {
            // ... the form gets submitted:
            document.getElementById("sectionForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
</script>
<?= $this->endSection(); ?>