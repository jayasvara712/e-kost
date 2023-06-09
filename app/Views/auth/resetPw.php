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
                        <h4>Reset Password</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="<?= site_url('/reset/' . $id) ?>">

                            <?= csrf_field() ?>

                            <input type="hidden" name="id_user" value="<?= $id ?>">

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
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Reset
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