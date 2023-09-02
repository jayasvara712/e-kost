<?= $this->extend('layout/template_penghuni'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">

        <div class="section-body">

            <!-- alert -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div id="success" style="visibility: hidden">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif ?>

            <div class="card">
                <div class="card-body">
                    <h2 class="section-title">Denah <?= getenv('judul_web') ?></h2>

                    <div class="row">

                        <?php
                        foreach ($denah as $key => $data) :
                        ?>

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <article class="article article-style-c">
                                    <div class="article-header">
                                        <div class="article-image" data-background="uploads/denah/<?= $data->image_denah ?>">
                                        </div>
                                    </div>
                                    <div class="article-details">
                                        <div class="article-title">
                                            <h2><a href="#"><?= $data->judul_denah ?></a></h2>
                                        </div>
                                        <p><?= $data->deskripsi_denah ?> </p>
                                    </div>
                                </article>
                            </div>

                        <?php endforeach ?>

                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>