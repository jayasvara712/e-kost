<?php if (session('role') != 'penghuni') { ?>
    <?= $this->extend('layout/template'); ?>
    <?= $this->section('content'); ?>
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Setting <?= session()->role ?></h1>
            </div>
        <?php } else { ?>
            <?= $this->extend('layout/template_penghuni'); ?>
            <?= $this->section('content'); ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">

                    <div class="section-body">
                    <?php } ?>

                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <form action="<?= site_url(session()->role . '/update/' . session()->id_user) ?>" method="post" enctype="multipart/form-data">
                                        <?= csrf_field() ?>

                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="nama" value="<?= session()->role ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" name="username" value="<?= $user->username ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input id="email" type="email" class="form-control" name="email" value="<?= $user->email ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Password Lama</label>
                                            <input id="password" type="password" class="form-control <?= (validation_show_error('password_lama')) ? 'is-invalid' : ''; ?><?= session()->getFlashdata('error') ? 'is-invalid' : '' ?>" data-indicator="pwindicator" name="password_lama" value="<?= old('password_lama') ?>">
                                            <div class="invalid-feedback">
                                                <?= (validation_show_error('password_lama')) ? validation_show_error('password_lama') : ''; ?>
                                                <?= session()->getFlashdata('error') ? session()->getFlashdata('error') : '' ?>
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

                                        <?php if (session()->role != 'admin') : ?>
                                            <div class="form-group">
                                                <label>Nomor Telepon</label>
                                                <input type="text" class="form-control phone-number <?= (validation_show_error('no_telp')) ? 'is-invalid' : ''; ?>" name="no_telp" value="<?= $user->$no_telp ?>">
                                                <div class="invalid-feedback">
                                                    <?= (validation_show_error('no_telp')) ? validation_show_error('no_telp') : ''; ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input type="text" class="form-control <?= (validation_show_error('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" value="<?= $user->$alamat ?>">
                                                <div class="invalid-feedback">
                                                    <?= (validation_show_error('alamat')) ? validation_show_error('alamat') : ''; ?>
                                                </div>
                                            </div>
                                        <?php endif ?>

                                        <a href="<?= site_url(session()->role) ?>" class="btn btn-danger"><span>Kembali</span></a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>

            <?= $this->endSection() ?>