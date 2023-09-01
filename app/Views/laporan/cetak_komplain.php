<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?> | <?= $company ?></title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            page-break-inside: avoid;
        }

        td,
        th {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .table {
            margin-top: 50px;
            display: table;
            width: 300px;
        }

        .tr {
            display: table-row;
            padding-bottom: 10px;
        }

        .td {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            direction: rtl;
            line-height: 10px;
        }

        .hr {
            padding-top: 100px;
            line-height: 200%;
        }

        .no_data {
            text-align: center;
        }
    </style>
</head>

<body>
    <center>
        <h1><?= $company ?></h1>
        <h3><?= $alamat ?></h3>
    </center>
    <hr>
    <h4 align="center"><?= $title ?></h4>

    <div class="tickets">
        <div class="ticket-content">

            <?php foreach ($dataTiket as $key => $value) : ?>
                <div class="ticket-header">
                    <div class="ticket-detail">
                        <div class="ticket-title">
                            <h4>
                                <?php if ($role == 'Karyawan') { ?>
                                    <?= $value->user == 1 ? $value->nama_karyawan : 'admin' ?>
                                <?php } else if ($role == 'Penyewa') { ?>
                                    <?= $value->user == 1 ? $value->nama_penghuni : $value->nama_karyawan ?>
                                <?php } ?>
                            </h4>
                        </div>
                        <div class="ticket-info">
                            <div class="text-primary font-weight-600"><?= $value->tgl_pesan ?></div>
                        </div>
                    </div>
                </div>

                <div class="ticket-description">
                    <p><?= $value->pesan ?></p>

                    <?php if ($value->gambar != '' || $value->gambar != null) : ?>
                        <div class="gallery">
                            <div class="gallery-item" data-image="<?= base_url() . '/uploads/tiket/' . $value->id_tiket . '/' . $value->gambar ?>"></div>
                        </div>
                    <?php endif ?>

                    <div class="ticket-divider"></div>
                </div>

            <?php endforeach ?>
        </div>
    </div>

    <div class="hr"></div>

    <!-- ttd -->
    <div class="table">
        <div class="tr">
        </div>
        <div class="tr">
            <p class="td">Denpasar, <?= $date ?></p>
        </div>
        <div class="tr">
            <p class=""></p>
        </div>
        <div class="tr">
            <p class=""></p>
        </div>
        <div class="tr">
            <p class=""></p>
        </div>
        <h3 class="td"><?= $owner ?><br></h3>
        <div class="tr">
            <h1 class="td">
                <hr>
            </h1>
        </div>
    </div>
</body>

</html>