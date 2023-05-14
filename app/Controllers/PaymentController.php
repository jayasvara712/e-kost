<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKamar;
use App\Models\ModelPenghuni;
use App\Models\ModelPenyewaan;
use App\Models\ModelPenyewaanDetail;

class PaymentController extends BaseController
{
    private $menu = "<script language=\"javascript\">menu('m-penyewaan');</script>";
    private $header = "<script language=\"javascript\">menu('m-page');</script>";
    private $url = "payment";

    protected $modelPenghuni;
    protected $modelPenyewaan;
    protected $modelPenyewaanDetail;
    protected $modelKamar;
    protected $helpers = ['form'];

    function __construct()
    {
        $this->modelPenghuni = new ModelPenghuni();
        $this->modelKamar = new ModelKamar();
        $this->modelPenyewaan = new ModelPenyewaan();
        $this->modelPenyewaanDetail = new ModelPenyewaanDetail();
    }

    public function midtrans()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = getenv('midtrans_server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }

    public function buatNoInvoice()
    {
        $tanggal = $this->request->getPost('tanggal');
        $no_invoice = $this->modelPenyewaanDetail->noInvoice($tanggal)->getRowArray();
        $data = $no_invoice['noInvoice'];

        $lastNoUrut = substr($data, -4);
        // menambah nomor urut
        $nextNoUrut = intval($lastNoUrut) + 1;
        // membuat nomor invoice
        $noInvoice = date('dmy', strtotime($tanggal)) . sprintf('%04s', $nextNoUrut);

        $json = [
            'noInvoice' => $noInvoice
        ];
        echo json_encode($json);
    }

    public function index()
    {
        //
    }

    public function payMidtrans()
    {
        session()->remove('pembayaran');
        session()->set(['pembayaran'       => 'none']);

        if ($this->request->isAJAX()) {
            $post = $this->request->getPost();
            $id_penyewaan = $post['id_penyewaan'];
            $periode = $post['periode'];
            $no_invoice = $post['no_invoice'];

            $cekdata = $this->modelPenyewaan->getAllDetail($id_penyewaan);

            if ($cekdata) {

                $this->midtrans();

                $transaction_details = array(
                    'order_id'    => rand(),
                    'gross_amount'  => $cekdata[0]->harga_kamar
                );

                // Populate customer's info
                $customer_details = array(
                    'first_name'       => $cekdata[0]->nama_penghuni,
                    'phone'            => $cekdata[0]->no_telp_penghuni,
                );

                $params = array(
                    'transaction_details' => $transaction_details,
                    // 'item_details'        => $items,
                    'customer_details'    => $customer_details
                );

                $json = [
                    'id_penyewaan' => $id_penyewaan,
                    'periode' => $periode,
                    'no_invoice' => $no_invoice,
                    'payment' => $cekdata[0]->harga_kamar,
                    'snapToken' => \Midtrans\Snap::getSnapToken($params)
                ];
            } else {
                $json = [
                    'error' => 'Maaf kamar belum tersedia'
                ];
                session()->setFlashdata('error', $json['error']);
            }
            echo json_encode($json);
        }
    }

    public function payment()
    {
        $post = $this->request->getPost();
        if ($this->request->isAJAX()) {
            $no_invoice = $post['no_invoice'];
            $id_penyewaan = $post['id_penyewaan'];
            $payment = $post['payment'];
            $order_id = $post['order_id'];
            $payment_type = $post['payment_type'];
            $transaction_time = $post['transaction_time'];
            $transaction_status = $post['transaction_status'];
            $va_number = $post['va_number'];
            $bank = $post['bank'];
            $periode = $post['periode'];

            $data1 = [
                'last_payment' => $payment,
                'payment_period' => $periode,
                'payment_method' => 'M',
                'last_transaction_time' => $transaction_time,
                'last_transaction_status' => $transaction_status,
            ];
            $this->modelPenyewaan->update($id_penyewaan, $data1);

            $data2 = [
                'id_penyewaan' => $id_penyewaan,
                'no_invoice' => $no_invoice,
                'payment' => $payment,
                'order_id' => $order_id,
                'payment_type' => $payment_type,
                'payment_method' => 'M',
                'transaction_time' => $transaction_time,
                'transaction_status' => $transaction_status,
                'va_number' => $va_number,
                'bank' => $bank,
            ];
            $this->modelPenyewaanDetail->insert($data2);

            $json = [
                'id_penyewaan' => $id_penyewaan,
                'success' => 'Transaksi Berhasil, silahkan lakukan pembayaran!'
            ];
            echo json_encode($json);
        }
    }
}
