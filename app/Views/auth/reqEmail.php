<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <h5><?= getenv('judul_web'); ?></h5>
                </div>

                <div class="card card-primary">

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div id="error" style="visibility: hidden">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif ?>

                    <div class="card-header">
                        <h4>Forgot Password</h4>
                    </div>

                    <div class="card-body">
                        <p class="text-muted">We will send a link to reset your password</p>
                        <form method="POST" action="sendLink" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control <?= (session()->getFlashdata('error')) ? 'is-invalid' : ''; ?>" name="email" tabindex="1" required autofocus>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Forgot Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="simple-footer">
                    Copyright &copy; Stisla 2018
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>