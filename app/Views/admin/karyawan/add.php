<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Karyawan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data User</a></div>
                <div class="breadcrumb-item">Data karyawan</div>
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

                                <input type="hidden" class="form-control" name="role" value="karyawan">

                                <div class="form-group">
                                    <label>Nomor KTP</label>
                                    <input type="text" class="form-control phone-number <?= (validation_show_error('nik_karyawan')) ? 'is-invalid' : ''; ?>" name="nik_karyawan" value="<?= old('nik_karyawan') ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('nik_karyawan')) ? validation_show_error('nik_karyawan') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control <?= (validation_show_error('nama_karyawan')) ? 'is-invalid' : ''; ?>" name="nama_karyawan" value="<?= old('nama_karyawan') ?>">
                                    <div class=" invalid-feedback">
                                        <?= (validation_show_error('nama_karyawan')) ? validation_show_error('nama_karyawan') : ''; ?>
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
                                    <input type="text" class="form-control phone-number <?= (validation_show_error('no_telp_karyawan')) ? 'is-invalid' : ''; ?>" name="no_telp_karyawan" value="<?= old('no_telp_karyawan') ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('no_telp_karyawan')) ? validation_show_error('no_telp_karyawan') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control selectric <?= (validation_show_error('jk_karyawan')) ? 'is-invalid' : ''; ?>" name="jk_karyawan" value="<?= old('jk_karyawan') ?>">
                                        <option value="">Pilih jenis kelamin</option>
                                        <option value="Laki-laki" <?= (old('jk_karyawan') == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="Perempuan" <?= (old('jk_karyawan') == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('jk_karyawan')) ? validation_show_error('jk_karyawan') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control <?= (validation_show_error('alamat_karyawan')) ? 'is-invalid' : ''; ?>" name="alamat_karyawan" value="<?= old('alamat_karyawan') ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('alamat_karyawan')) ? validation_show_error('alamat_karyawan') : ''; ?>
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