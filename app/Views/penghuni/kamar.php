<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Kamar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Karyawan</a></div>
                <div class="breadcrumb-item">Kamar</div>
            </div>
        </div>

        <div class="section-body">

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">x</button>
                        <?= session()->getFlashdata('success') ?>
                    </div>
                </div>
            <?php endif ?>
            <form action="<?= site_url('penghuni/penyewaan') ?>" method="POST" autocomplete="off" enctype="multipart/form-data" id="sectionForm">
                <?= csrf_field() ?>

                <div class="tab">
                    <input type="hidden" name="id_kamar" id="id_kamar" class="id_kamar" value="">
                    <input type="hidden" name="nomor_kamar" id="nomor_kamar" class="nomor_kamar" value="">
                    <input type="hidden" class="form-control" name="id_penghuni" id="id_penghuni" value="<?= session('id_penghuni') ?>">
                    <div class="row">

                        <?php
                        foreach ($kamar as $key => $value) :
                        ?>

                            <div class="col-12 col-sm-6 col-lg-6">
                                <div class="card <?= ($value['status_kamar'] == 'Tersedia') ? 'card-success' : 'card-danger' ?>">
                                    <div class="card-header">
                                        <h4>Kamar <?= $value['nomor_kamar'] ?></h4>
                                        <div class="card-header-action">
                                            <a data-collapse="#kamar<?= $value['id_kamar'] ?>" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                        </div>
                                    </div>
                                    <div class="collapse show" id="kamar<?= $value['id_kamar'] ?>">
                                        <div class="card-body">
                                            <h5>Fasilitas Kamar : </h5>
                                            <p><?= $value['fasilitas_kamar'] ?></p>
                                            <h5>Keterangan : </h5>
                                            <p><?= $value['keterangan_kamar'] ?></p>
                                            <h5>Staus : </h5>
                                            <p><?= $value['status_kamar'] ?></p>
                                            <h5>Harga Perbulan : </h5>
                                            <b><?= $value['harga_kamar'] ?></b>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-info" type="button" id="nextBtn" onclick="nextPrev(1,<?= $value['id_kamar'] ?>, <?= $value['harga_kamar'] ?>, <?= $value['nomor_kamar'] ?>)" <?= ($value['status_kamar'] == 'Tidak Tersedia') ? 'disabled' : '' ?>><i class="fas fa-cart-plus"></i> Pesan</button>
                                        </div>
                                    </div>
                                </div>
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
                                    <input type="text" class="form-control" name="harga_kamar" id="harga_kamar" value="" readonly>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Lama Penyewaan</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="lama_penyewaan" class="form-control" id="lama_penyewaan">
                                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                                            <option value="<?= $i ?>" <?= ($i == old('lama_penyewaan')) ? 'selected' : '' ?>><?= $i ?> Bulan</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Total Harga</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="total_harga" id="total_harga" readonly>
                                </div>
                            </div>

                            <div class="form-group row mb-4 content-section">
                            </div>

                            <button class="btn btn-primary" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
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
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

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
        currentTab = currentTab + n;
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