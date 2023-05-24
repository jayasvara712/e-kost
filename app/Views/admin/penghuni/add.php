<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Penghuni</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data User</a></div>
                <div class="breadcrumb-item">Data Penghuni</div>
                <div class="breadcrumb-item">Tambah</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="<?= site_url($url) ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <input type="hidden" class="form-control" name="role" value="penghuni">

                                <div class="form-group">
                                    <label>Nomor KTP</label>
                                    <input type="text" class="form-control phone-number <?= (validation_show_error('nik_penghuni')) ? 'is-invalid' : ''; ?>" name="nik_penghuni" value="<?= old('nik_penghuni') ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('nik_penghuni')) ? validation_show_error('nik_penghuni') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control <?= (validation_show_error('nama_penghuni')) ? 'is-invalid' : ''; ?>" name="nama_penghuni" value="<?= old('nama_penghuni') ?>">
                                    <div class=" invalid-feedback">
                                        <?= (validation_show_error('nama_penghuni')) ? validation_show_error('nama_penghuni') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control <?= (validation_show_error('username')) ? 'is-invalid' : ''; ?>" name="username" value="<?= old('username') ?>">
                                    <div class=" invalid-feedback">
                                        <?= (validation_show_error('username')) ? validation_show_error('username') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control <?= (validation_show_error('email')) ? 'is-invalid' : ''; ?>" name="email" value="<?= old('email') ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('email')) ? validation_show_error('email') : ''; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password" class="d-block">Password</label>
                                        <input id="password" type="password" class="form-control pwstrength <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" data-indicator="pwindicator" name="password" value="<?= old('password') ?>">
                                        <div class="invalid-feedback">
                                            <?= (validation_show_error('password')) ? validation_show_error('password') : ''; ?>
                                        </div>
                                        <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="password2" class="d-block">Konfirmasi Password</label>
                                        <input id="password2" type="password" class="form-control <?= (validation_show_error('password_conf')) ? 'is-invalid' : ''; ?>" name="password_conf" value="<?= old('password_conf') ?>">
                                        <div class="invalid-feedback">
                                            <?= (validation_show_error('password_conf')) ? validation_show_error('password_conf') : ''; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="text" class="form-control phone-number <?= (validation_show_error('no_telp_penghuni')) ? 'is-invalid' : ''; ?>" name="no_telp_penghuni" value="<?= old('no_telp_penghuni') ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('no_telp_penghuni')) ? validation_show_error('no_telp_penghuni') : ''; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label>Tempat Lahir</label>
                                        <input type="text" class="form-control <?= (validation_show_error('tempat_lahir_penghuni')) ? 'is-invalid' : ''; ?>" name="tempat_lahir_penghuni" value="<?= old('tempat_lahir_penghuni') ?>">
                                        <div class="invalid-feedback">
                                            <?= (validation_show_error('tempat_lahir_penghuni')) ? validation_show_error('tempat_lahir_penghuni') : ''; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <label>Tanggal Lahir</label>
                                        <input type="text" class="form-control datepicker <?= (validation_show_error('tgl_lahir_penghuni')) ? 'is-invalid' : ''; ?>" name="tgl_lahir_penghuni" value="<?= old('tgl_lahir_penghuni') ?>">
                                        <div class="invalid-feedback">
                                            <?= (validation_show_error('tgl_lahir_penghuni')) ? validation_show_error('tgl_lahir_penghuni') : ''; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control selectric <?= (validation_show_error('jk_penghuni')) ? 'is-invalid' : ''; ?>" name="jk_penghuni" value="<?= old('jk_penghuni') ?>">
                                        <option value="">Pilih jenis kelamin</option>
                                        <option value="Laki-laki" <?= (old('jk_penghuni') == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="Perempuan" <?= (old('jk_penghuni') == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('jk_penghuni')) ? validation_show_error('jk_penghuni') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control <?= (validation_show_error('alamat_penghuni')) ? 'is-invalid' : ''; ?>" name="alamat_penghuni" value="<?= old('alamat_penghuni') ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('alamat_penghuni')) ? validation_show_error('alamat_penghuni') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
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