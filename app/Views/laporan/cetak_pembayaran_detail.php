<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Invoice &mdash; Stisla</title>
    <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <table class="table table-borderless">
                <tr>
                    <td width='70%'>
                        <h1>Invoice</h1>
                    </td>
                    <td width='30%'>
                        <h5>#<?= $no_invoice ?></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>Pemesan:</h4>
                        <p>
                            <?= $nama_penghuni ?><br>
                            <?= $no_telp_penghuni ?><br>
                            <?= $alamat_penghuni ?>
                        </p>
                    </td>
                    <td>
                        <h4>Status:</h4>
                        <p>
                            <?php
                            if ($transaction_status == 'settlement') {
                                echo "<span class='badge badge-success'>Sudah Di Bayar</span>";
                            } else if ($transaction_status == 'pending') {
                                echo "<span class='badge badge-warning'>Belum Di Bayar</span>";
                            } else if ($transaction_status == 'expire') {
                                echo "<span class='badge badge-danger'>Pembayaran Gagal</span>";
                            } else if ($transaction_status == 'cancel') {
                                echo "<span class='badge badge-danger'>Pembayaran Dibatalkan</span>";
                            }
                            ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>Metode Pembayaran:</h5>
                        <p><?= $va_number == null ? strtoupper($payment_type) : strtoupper($bank) . ' ' . $va_number ?></p>
                    </td>
                    <td>
                        <h5>Tanggal Pemesanan:</h5>
                        <p><?= $tgl_penyewaan ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h4>Detail Pemesanan</h4>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table class="table table-striped table-hover table-md">
                            <tr>
                                <th>Nomor Kamar</th>
                                <th class="text-center">Tanggal Pembayaran</th>
                                <th class="text-center">Harga</th>
                            </tr>
                            <tr>
                                <td><?= $nomor_kamar ?></td>
                                <td class="text-center"><?= $transaction_time ?></td>
                                <td class="text-center">Rp.<?= $harga_kamar ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right">
                        <h4>Total</h4>
                        <h4>Rp.<?= $harga_kamar ?></h4>
                    </td>
                </tr>
            </table>

        </div>


    </div>
</body>

</html>