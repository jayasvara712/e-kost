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
            <th>No</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>No Telepon</th>
            <th>Alamat</th>
        </tr>
        <?php if ($karyawan) { ?>
            <?php foreach ($karyawan as $key => $value) : ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $value->nama_karyawan ?></td>
                    <td><?= $value->nik_karyawan ?></td>
                    <td><?= $value->no_telp_karyawan ?></td>
                    <td><?= $value->alamat_karyawan ?></td>
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