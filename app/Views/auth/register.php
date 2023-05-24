<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <div class="login-brand">
                    <h5><?= getenv('judul_web'); ?></h5>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Register</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="registerProcess">

                            <?= csrf_field() ?>

                            <input type="hidden" name="role" value="penghuni">

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
                                    <input type="date" class="form-control <?= (validation_show_error('tgl_lahir_penghuni')) ? 'is-invalid' : ''; ?>" name="tgl_lahir_penghuni" value="<?= date('Y-m-d') ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('tgl_lahir_penghuni')) ? validation_show_error('tgl_lahir_penghuni') : ''; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control selectric <?= (validation_show_error('jk_penghuni')) ? 'is-invalid' : ''; ?>" name="jk_penghuni" value="<?= old('jk_penghuni') ?>">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
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
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="agree" class="custom-control-input <?= (validation_show_error('agree')) ? 'is-invalid' : ''; ?>" id="agree">
                                    <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="simple-footer">
                    <?= getenv('copyright') ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>