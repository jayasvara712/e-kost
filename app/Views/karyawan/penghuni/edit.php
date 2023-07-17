<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Penyewa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Karyawan</a></div>
                <div class="breadcrumb-item">Data Penyewa</div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="<?= site_url($url . '/update/' . $penghuni->id_penghuni) ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <input type="hidden" class="form-control" name="role" value="<?= $penghuni->role ?>">
                                <input type="hidden" class="form-control" name="id_user" value="<?= $penghuni->id_user ?>">

                                <div class="form-group">
                                    <label>Nomor KTP</label>
                                    <input type="text" class="form-control phone-number <?= (validation_show_error('nik_penghuni')) ? 'is-invalid' : ''; ?>" name="nik_penghuni" value="<?= $penghuni->nik_penghuni ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('nik_penghuni')) ? validation_show_error('nik_penghuni') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control <?= (validation_show_error('nama_penghuni')) ? 'is-invalid' : ''; ?>" name="nama_penghuni" value="<?= $penghuni->nama_penghuni ?>">
                                    <div class=" invalid-feedback">
                                        <?= (validation_show_error('nama_penghuni')) ? validation_show_error('nama_penghuni') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control <?= (validation_show_error('username')) ? 'is-invalid' : ''; ?>" name="username" value="<?= $penghuni->username ?>" readonly>
                                    <div class=" invalid-feedback">
                                        <?= (validation_show_error('username')) ? validation_show_error('username') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control <?= (validation_show_error('email')) ? 'is-invalid' : ''; ?>" name="email" value="<?= $penghuni->email ?>" readonly>
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('email')) ? validation_show_error('email') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="text" class="form-control phone-number <?= (validation_show_error('no_telp_penghuni')) ? 'is-invalid' : ''; ?>" name="no_telp_penghuni" value="<?= $penghuni->no_telp_penghuni ?>">
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('no_telp_penghuni')) ? validation_show_error('no_telp_penghuni') : ''; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label>Tempat Lahir</label>
                                        <input type="text" class="form-control <?= (validation_show_error('tempat_lahir_penghuni')) ? 'is-invalid' : ''; ?>" name="tempat_lahir_penghuni" value="<?= $penghuni->tempat_lahir_penghuni ?>">
                                        <div class="invalid-feedback">
                                            <?= (validation_show_error('tempat_lahir_penghuni')) ? validation_show_error('tempat_lahir_penghuni') : ''; ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <label>Tanggal Lahir</label>
                                        <input type="text" class="form-control datepicker <?= (validation_show_error('tgl_lahir_penghuni')) ? 'is-invalid' : ''; ?>" name="tgl_lahir_penghuni" value="<?= $penghuni->tgl_lahir_penghuni ?>">
                                        <div class="invalid-feedback">
                                            <?= (validation_show_error('tgl_lahir_penghuni')) ? validation_show_error('tgl_lahir_penghuni') : ''; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control selectric <?= (validation_show_error('jk_penghuni')) ? 'is-invalid' : ''; ?>" name="jk_penghuni">
                                        <option value="Laki-laki" <?= ($penghuni->jk_penghuni == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="Perempuan" <?= ($penghuni->jk_penghuni == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= (validation_show_error('jk_penghuni')) ? validation_show_error('jk_penghuni') : ''; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control <?= (validation_show_error('alamat_penghuni')) ? 'is-invalid' : ''; ?>" name="alamat_penghuni" value="<?= $penghuni->alamat_penghuni ?>">
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