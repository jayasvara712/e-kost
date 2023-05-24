<?php

namespace App\Controllers\Admin;

use App\Models\ModelKamar;
use App\Models\ModelPenghuni;
use App\Models\ModelPenyewaan;
use App\Models\ModelPenyewaanDetail;
use App\Controllers\BaseController;

class PenyewaanController extends BaseController
{
    private $menu = "<script language=\"javascript\">menu('m-penyewaan');</script>";
    private $header = "<script language=\"javascript\">menu('m-page');</script>";
    private $url = "admin/penyewaan";

    protected $modelPenghuni;
    protected $modelPenyewaan;
    protected $modelPenyewaanDetail;
    protected $modelKamar;

    function __construct()
    {
        $this->modelPenyewaan = new ModelPenyewaan();
        $this->modelPenyewaanDetail = new ModelPenyewaanDetail();
        $this->modelPenghuni = new ModelPenghuni();
        $this->modelKamar = new ModelKamar();
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

    public function invoice()
    {
        $tanggal = date('Y-m-d');
        $no_invoice = $this->modelPenyewaanDetail->noInvoice($tanggal)->getRowArray();
        $data = $no_invoice['noInvoice'];

        $lastNoUrut = substr($data, -4);
        // menambah nomor urut
        $nextNoUrut = intval($lastNoUrut) + 1;
        // membuat nomor invoice
        $noFaktur = date('dmy', strtotime($tanggal)) . sprintf('%04s', $nextNoUrut);
        return $noFaktur;
    }

    public function buatNoInvoice()
    {
        $tanggal = $this->request->getPost('tanggal');
        $no_invoice = $this->modelPenyewaan->noInvoice($tanggal)->getRowArray();
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
        $status_count = [];
        $dataPenyewaan = $this->modelPenyewaan->getAll();
        foreach ($dataPenyewaan as $key => $value) {
            array_push($status_count, $this->modelPenyewaanDetail->cek_status($value->id_penyewaan)->getFirstRow()->x);
        }
        $data = [
            'status'    => $status_count,
            'url'       => $this->url,
            'penyewaan' => $dataPenyewaan
        ];
        echo view($this->url, $data) . $this->menu . $this->header;
    }

    public function penyewaan_detail($id = null)
    {
        $cekData = $this->modelPenyewaan->getAllDetail($id);
        $id_penyewaan = $cekData[0]->id_penyewaan;
        $status_count = $this->modelPenyewaanDetail->cek_status($id_penyewaan)->getFirstRow();

        if ($cekData) {

            $data = [
                'url'               => $this->url,
                'status'            => (int)$status_count->x,
                'lama_penyewaan'   => $cekData[0]->lama_penyewaan,
                'no_kamar'          => $cekData[0]->nomor_kamar,
                'payment_method'    => $cekData[0]->payment_method,
                'id_penyewaan'      => $id_penyewaan,
                'penyewaan'         => $cekData,
            ];

            return view($this->url . '/penyewaan_detail', $data) . $this->menu . $this->header;
        } else {
            return view($this->url) . $this->menu . $this->header;
        }
    }

    public function pembayaran_detail($id = null)
    {
        $cekData = $this->modelPenyewaanDetail->find($id);

        if ($cekData) {
            $this->midtrans();
            $dataPenyewaan = $this->modelPenyewaan->find($cekData->id_penyewaan);
            $dataPenghuni = $this->modelPenghuni->find($dataPenyewaan->id_penghuni);
            $dataKamar = $this->modelKamar->find($dataPenyewaan->id_kamar);
            $periode = $this->modelPenyewaanDetail->periode($cekData->id_penyewaan)->getFieldCount();

            $status = \Midtrans\Transaction::status($cekData->order_id);

            if ($status->transaction_status == 'settlement') {
                $data1 = [
                    'transaction_status'    => $status->transaction_status,
                    'transaction_time'      => $status->settlement_time,
                ];
                $data2 = [
                    'last_transaction_status'    => $status->transaction_status,
                    'last_transaction_time'      => $status->settlement_time,
                    'last_payment'          => $status->gross_amount,
                ];
            } else {
                $data1 = [
                    'transaction_status'    => $status->transaction_status,
                    'transaction_time'      => $status->transaction_time,
                ];
                $data2 = [
                    'last_transaction_status'    => $status->transaction_status,
                    'last_transaction_time'      => $status->transaction_time,
                    'last_payment'          => $status->gross_amount,
                ];
            }
            $this->modelPenyewaanDetail->update($id, $data1);
            $this->modelPenyewaan->update($cekData->id_penyewaan, $data2);

            $data = [
                'url'                   => $this->url,
                'id_penyewaan_detail'   => $id,
                'id_penyewaan'          => $cekData->id_penyewaan,
                'no_invoice'            => $cekData->no_invoice,
                'tgl_penyewaan'         => $dataPenyewaan->tgl_penyewaan,
                'lama_penyewaan'        => $dataPenyewaan->lama_penyewaan,
                'payment_method'        => $cekData->payment_method,
                'transaction_status'    => $cekData->transaction_status,
                'bank'                  => $cekData->bank,
                'va_number'             => $cekData->va_number,
                'tgl_penyewaan'         => date('d M, Y', strtotime($dataPenyewaan->tgl_penyewaan)),
                'transaction_time'      => date('d M, Y', strtotime($cekData->transaction_time)),
                'lama_penyewaan'        => $dataPenyewaan->lama_penyewaan,
                'harga_kamar'           => number_format($cekData->payment, 0, ',', '.'),

                'no_kamar'           => $dataKamar->nomor_kamar,
                'payment'               => number_format($cekData->payment, 0, ',', '.'),
                'period'                => $periode,

                'nama_penghuni'         => $dataPenghuni->nama_penghuni,
                'no_telp_penghuni'      => $dataPenghuni->no_telp_penghuni,
                'alamat_penghuni'       => $dataPenghuni->alamat_penghuni,


            ];

            return view($this->url . '/cek_transaksi', $data) . $this->menu . $this->header;
        } else {
            exit('Data tidak ditemukan');
        }
    }
}
