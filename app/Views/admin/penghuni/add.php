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
                <div class="breadcrumb-item">Tambah Data Penghuni</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <form action="<?= site_url('penghuni') ?>" method="POST" autocomplete="off" enctype="multipart/form-data">

                            <input type="hidden" class="form-control" name="role" value="penghuni">

                            <div class="card-body">

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="nama_penghuni">

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
                                        <input type="date" class="form-control" name="tgl_lahir_penghuni">

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
                                        <input type="text" class="form-control" name="tempat_lahir_penghuni">

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
                                        <input type="text" class="form-control" name="nik_penghuni">

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
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="Laki - laki">Laki - laki</option>
                                            <option value="Perempuan">Perempuan</option>
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
                                        <input type="text" class="form-control" name="no_telp_penghuni">

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
                                        <textarea class="form-control" name="alamat_penghuni"></textarea>

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
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="username">

                                        <?php if (session()->getFlashdata('error')) :
                                            if (isset(session()->getFlashdata('error')['username'])) :
                                                echo ' <div class="alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                                ' . session()->getFlashdata('error')['username'] . '
                                            </div>
                                        </div>';
                                            endif;
                                        endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="email" class="form-control" name="email">

                                        <?php if (session()->getFlashdata('error')) :
                                            if (isset(session()->getFlashdata('error')['email'])) :
                                                echo ' <div class="alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                                ' . session()->getFlashdata('error')['email'] . '
                                            </div>
                                        </div>';
                                            endif;
                                        endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="password" class="form-control" name="password">

                                        <?php if (session()->getFlashdata('error')) :
                                            if (isset(session()->getFlashdata('error')['password'])) :
                                                echo ' <div class="alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                                ' . session()->getFlashdata('error')['password'] . '
                                            </div>
                                        </div>';
                                            endif;
                                        endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Konfirmasi Password</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="password" class="form-control" name="conf_password">

                                        <?php if (session()->getFlashdata('error')) :
                                            if (isset(session()->getFlashdata('error')['conf_password'])) :
                                                echo ' <div class="alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                                ' . session()->getFlashdata('error')['conf_password'] . '
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