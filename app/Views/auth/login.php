<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                </div>

                <div class="card card-primary">

                    <?php if (session()->getFlashdata('success')) : ?>
                        <div id="success" style="visibility: hidden">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif ?>
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div id="error" style="visibility: hidden">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif ?>

                    <div class="card-header">
                        <h4>Login</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="/loginProcess" class="needs-validation" novalidate="">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                    Email tidak boleh kosong !
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                    <div class="float-right">
                                        <a href="/forgot_password" class="text-small">
                                            Forgot Password?
                                        </a>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <input id="password1" type="password" class="form-control" name="password" tabindex="2" required>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" onclick="showPass()">
                                            <i class="fas fa-eye" id="pweye1"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Password tidak boleh kosong !
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                                </div>
                            </div> -->

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Login
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="mt-5 text-muted text-center">
                    Don't have an account? <a href="register">Create One</a>
                </div>
                <div class="simple-footer">
                    <?= getenv('copyright') ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>