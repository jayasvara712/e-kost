<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Denah</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    Denah
                </div>
            </div>
        </div>

        <div class="section-body">

            <h2 class="section-title">Denah <?= getenv('judul_web') ?></h2>

            <?php
            foreach ($denah as $key => $data) :
            ?>

                <div class="row">
                    <div class="col-12 col-md-4 col-lg-4">
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
                </div>

            <?php endforeach ?>

        </div>
    </section>
</div>

<?= $this->endSection(); ?>