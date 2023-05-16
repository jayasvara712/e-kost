<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data karyawan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
                <div class="breadcrumb-item">karyawan</div>
                <div class="breadcrumb-item">Tambah Data karyawan</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="<?= site_url($url . '/update/' . $karyawan->id_karyawan) ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <input type="hidden" class="form-control" name="role" value="<?= $karyawan->role ?>">
                                <input type="hidden" class="form-control" name="id_user" value="<?= $karyawan->id_user ?>">

                                <div class="form-group">
                                    <label>Nomor KTP</label>
                                    <input type="text" class="form-control phone-number <?= (validation_show_error('nik_karyawan')) ? 'is-invalid' : ''; ?>" name="nik_karyawan" value="<?= $karyawan->nik_karyawan ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('nik_karyawan')) ? validation_show_error('nik_karyawan') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control <?= (validation_show_error('nama_karyawan')) ? 'is-invalid' : ''; ?>" name="nama_karyawan" value="<?= $karyawan->nama_karyawan ?>">
                                    <div class=" invalid-feedback">
                                        <?= (validation_show_error('nama_karyawan')) ? validation_show_error('nama_karyawan') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control <?= (validation_show_error('username')) ? 'is-invalid' : ''; ?>" name="username" value="<?= $karyawan->username ?>" readonly>
                                    <div class=" invalid-feedback">
                                        <?= (validation_show_error('username')) ? validation_show_error('username') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control <?= (validation_show_error('email')) ? 'is-invalid' : ''; ?>" name="email" value="<?= $karyawan->email ?>" readonly>
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('email')) ? validation_show_error('email') : ''; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password" class="d-block">Password</label>
                                        <div class="input-group">
                                            <input id="password1" type="password" class="form-control pwstrength <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" data-indicator="pwindicator" name="password" value="<?= old('password') ?>">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" onclick="showPass()">
                                                    <i class="fas fa-eye" id="pweye1"></i>
                                                </div>
                                            </div>
                                        </div>
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
                                        <div class="input-group">
                                            <input id="password2" type="password" class="form-control <?= (validation_show_error('password_conf')) ? 'is-invalid' : ''; ?>" name="password_conf" value="<?= old('password_conf') ?>">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" onclick="showPassConfrm()">
                                                    <i class="fas fa-eye" id="pweye2"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= (validation_show_error('password_conf')) ? validation_show_error('password_conf') : ''; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="text" class="form-control phone-number <?= (validation_show_error('no_telp_karyawan')) ? 'is-invalid' : ''; ?>" name="no_telp_karyawan" value="<?= $karyawan->no_telp_karyawan ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('no_telp_karyawan')) ? validation_show_error('no_telp_karyawan') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control selectric <?= (validation_show_error('jk_karyawan')) ? 'is-invalid' : ''; ?>" name="jk_karyawan">
                                        <option value="Laki-laki" <?= ($karyawan->jk_karyawan == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="Perempuan" <?= ($karyawan->jk_karyawan == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('jk_karyawan')) ? validation_show_error('jk_karyawan') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control <?= (validation_show_error('alamat_karyawan')) ? 'is-invalid' : ''; ?>" name="alamat_karyawan" value="<?= $karyawan->alamat_karyawan ?>">
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