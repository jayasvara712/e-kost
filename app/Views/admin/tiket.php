<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Data Komplain <?= $judul ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Data Komplain</div>
                <div class="breadcrumb-item"><?= $judul ?></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <?php if (session()->getFlashdata('success')) : ?>
                            <div id="success" style="visibility: hidden">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif ?>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tiket as $key => $value) : ?>
                                            <tr>
                                                <td>
                                                    <?= $key + 1 ?>
                                                </td>
                                                <td>
                                                    <?= $value->judul_tiket ?>
                                                </td>
                                                <td>
                                                    <?= $value->tgl_tiket ?>
                                                </td>
                                                <td>
                                                    <?php if ($value->status_tiket == 'waiting') {
                                                        echo "<span class='badge badge-warning'><i class='fas fa-clock'></i></span>";
                                                    } else if ($value->status_tiket == 'done') {
                                                        echo "<span class='badge badge-success'><i class='fas fa-check'></i></span>";
                                                    } else if ($value->status_tiket == 'ongoing') {
                                                        echo "<span class='badge badge-success'><i class='fas fa-spinner'></i></span>";
                                                    } else {
                                                        "<span class='badge badge-success'><i class='fas fa-times'></i></span>";
                                                    } ?>
                                                </td>
                                                <td>
                                                    <!-- tiket menunggu di ambil oleh admin -->
                                                    <?php if ($value->id_penghuni == null && $value->status_tiket == 'waiting') :
                                                    ?>
                                                        <form action="<?= site_url($url . '/update/' . $value->id_tiket) ?>" class="d-inline" method="post">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="status_tiket" value="ongoing">
                                                            <button class="btn btn-primary"><i class="fas fa-plus"></i></button>
                                                        </form>
                                                    <?php endif; ?>
                                                    <!-- tiket sudah diambil oleh admin dan dalam proses penanganan -->
                                                    <?php if ($value->status_tiket != 'waiting') : ?>
                                                        <a href="<?= site_url($url . 'detail/show/' .  $value->id_tiket) ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                    <?php endif ?>
                                                    <!-- tiket jika sudah selesai diproses oleh admin -->
                                                    <?php if ($value->id_penghuni == null && $value->status_tiket == 'ongoing') :
                                                    ?>
                                                        <form action="<?= site_url($url . '/update/' . $value->id_tiket) ?>" class="d-inline" method="post">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="id_karyawan" value="<?= session('id_karyawan') ?>">
                                                            <input type="hidden" name="status_tiket" value="done">
                                                            <button class="btn btn-success"><i class="fas fa-check"></i></button>
                                                        </form>
                                                    <?php endif ?>
                                                    <!-- tiket jika sudah selesai  -->
                                                    <?php if ($value->status_tiket == 'done') : ?>
                                                        <a href="<?= site_url('admin/laporan/cetak_komplain/' .  $value->id_tiket) ?>" class="btn btn-primary" target="_blank"><i class="fas fa-print"></i></a>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?= $this->endSection(); ?>