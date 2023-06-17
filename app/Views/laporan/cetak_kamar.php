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
    <table>
        <tr>
            <th>Nomor Kamar</th>
            <th>Tipe Kamar</th>
            <th>Harga</th>
            <th>Fasilitas</th>
            <th>Status</th>
            <th>Keterangan</th>
        </tr>
        <?php if ($dataKamar) { ?>
            <?php foreach ($dataKamar['kamar'] as $key => $kamar) :  ?>
                <tr>
                    <td><?= $kamar['nomor_kamar'] ?></td>
                    <td><?= $kamar['judul_tipe_kamar'] ?></td>
                    <td>Rp. <?= number_format($kamar['harga_kamar'], 0, ',', '.') ?></td>
                    <td>
                        <?php foreach ($dataKamar['fasilitas'] as $key => $fasilitas) : ?>
                            <?= $kamar['id_kamar'] == $fasilitas['id_kamar'] ? $fasilitas['judul_fasilitas'] . ',' : '' ?>
                        <?php endforeach; ?>
                    </td>
                    <td><?= $kamar['status_kamar'] ?></td>
                    <td><?= $kamar['keterangan_kamar'] ?></td>
                </tr>
            <?php endforeach ?>

            <?= $key + 1 % 10 == 0 ? '<div style="page-break-before:always;"> </div>' : '' ?>
        <?php } else {
            echo '<tr><td class="no_data" colspan="5">Belum Ada Data</td></tr>';
        } ?>
    </table>
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