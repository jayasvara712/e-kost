<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Komplain</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Komplain</div>
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

                        <div class="card-header">
                            <h4 class="btn-group">
                                <a href="<?= site_url($url . "/new") ?>" class="btn btn-success btn-lg">
                                    <i class="fas fa-plus"></i> Buat Komplain</a>
                            </h4>
                        </div>

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
                                                    <a href="<?= site_url($url . 'detail/show/' .  $value->id_tiket) ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>
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