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
            <th>Nama Penghuni</th>
            <th>Tanggal Pembayaran</th>
            <th>Pembayaran</th>
            <th>Status</th>
        </tr>
        <?php if ($pembayaran) { ?>
            <?php foreach ($pembayaran as $key => $value) :  ?>
                <tr>
                    <td><?= $value->nomor_kamar ?></td>
                    <td><?= $value->nama_penghuni ?></td>
                    <td><?= date('d M, Y', strtotime($value->transaction_time)) ?></td>
                    <td>Rp. <?= number_format($value->payment, 0, ',', '.') ?></td>
                    <td><?= $value->transaction_status == 'settlement' ? 'Lunas' : ''  ?><?= $value->transaction_status == 'pending' ? 'Belum Lunas' : ''  ?><?= $value->transaction_status == 'cancel' ? 'Dibatalkan' : ''  ?><?= $value->transaction_status == 'expire' ? 'Gagal' : ''  ?></td>
                </tr>
            <?php endforeach ?>

            <?php if ($key < 7) {
                ($key + 1) % 9 == 0 ? '<div style="page-break-before:always;"> </div>' : '';
            } else {
                echo '<div style="page-break-before:always;"> </div>';
            } ?>
        <?php } else {
            echo '<tr><td class="no_data" colspan="6">Belum Ada Data</td></tr>';
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