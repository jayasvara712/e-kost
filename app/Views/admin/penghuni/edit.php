<?= $this->extend('library/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Data Penghuni</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
                <div class="breadcrumb-item">Penghuni</div>
                <div class="breadcrumb-item">Edit Data Penghuni</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="<?= site_url('penghuni/update/' . $penghuni->id_penghuni) ?>" method="post" autocomplete="off" enctype="multipart/form-data">

                            <div class="card-body">

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="nama_penghuni" value="<?= $penghuni->nama_penghuni ?>">

                                        <?php if (session()->getFlashdata('error')) :
                                            if (isset(session()->getFlashdata('error')['nama_penghuni'])) :
                                                echo ' <div class="alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                                ' . session()->getFlashdata('error')['nama_penghuni'] . '
                                            </div>
                                        </div>';
                                            endif;
                                        endif; ?>

                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Lahir</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="date" class="form-control" name="tgl_lahir_penghuni" value="<?= $penghuni->tgl_lahir_penghuni ?>">

                                        <?php if (session()->getFlashdata('error')) :
                                            if (isset(session()->getFlashdata('error')['tgl_lahir_penghuni'])) :
                                                echo ' <div class="alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                                ' . session()->getFlashdata('error')['tgl_lahir_penghuni'] . '
                                            </div>
                                        </div>';
                                            endif;
                                        endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tempat Lahir</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="tempat_lahir_penghuni" value="<?= $penghuni->tempat_lahir_penghuni
                                                                                                                    ?>">

                                        <?php if (session()->getFlashdata('error')) :
                                            if (isset(session()->getFlashdata('error')['tempat_lahir_penghuni'])) :
                                                echo ' <div class="alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                                ' . session()->getFlashdata('error')['tempat_lahir_penghuni'] . '
                                            </div>
                                        </div>';
                                            endif;
                                        endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Induk Kependudukan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="nik_penghuni" value="<?= $penghuni->nik_penghuni
                                                                                                            ?>">

                                        <?php if (session()->getFlashdata('error')) :
                                            if (isset(session()->getFlashdata('error')['nik_penghuni'])) :
                                                echo ' <div class="alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                                ' . session()->getFlashdata('error')['nik_penghuni'] . '
                                            </div>
                                        </div>';
                                            endif;
                                        endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Kelamin</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control" name="jk_penghuni">
                                            <option value="Laki - laki" <?php if ($penghuni->jk_penghuni == 'Laki - laki') {
                                                                            echo 'Selected';
                                                                        } ?>>Laki - laki</option>
                                            <option value="Perempuan" <?php if ($penghuni->jk_penghuni == 'Perempuan') {
                                                                            echo 'Selected';
                                                                        } ?>>Perempuan</option>
                                        </select>

                                        <?php if (session()->getFlashdata('error')) :
                                            if (isset(session()->getFlashdata('error')['jk_penghuni'])) :
                                                echo ' <div class="alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                                ' . session()->getFlashdata('error')['jk_penghuni'] . '
                                            </div>
                                        </div>';
                                            endif;
                                        endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No Telp</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="no_telp_penghuni" value="<?= $penghuni->no_telp_penghuni
                                                                                                                ?>">

                                        <?php if (session()->getFlashdata('error')) :
                                            if (isset(session()->getFlashdata('error')['no_telp_penghuni'])) :
                                                echo ' <div class="alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                                ' . session()->getFlashdata('error')['no_telp_penghuni'] . '
                                            </div>
                                        </div>';
                                            endif;
                                        endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea class="form-control" name="alamat_penghuni"><?= $penghuni->alamat_penghuni ?></textarea>

                                        <?php if (session()->getFlashdata('error')) :
                                            if (isset(session()->getFlashdata('error')['alamat_penghuni'])) :
                                                echo ' <div class="alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                                ' . session()->getFlashdata('error')['alamat_penghuni'] . '
                                            </div>
                                        </div>';
                                            endif;
                                        endif; ?>
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