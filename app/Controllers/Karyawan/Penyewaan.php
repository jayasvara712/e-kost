<?php

namespace App\Controllers\Karyawan;

use App\Models\ModelKamar;
use App\Models\ModelPenghuni;
use App\Models\ModelPenyewaan;
use CodeIgniter\RESTful\ResourceController;

class Penyewaan extends ResourceController
{
    private $menu = "<script language=\"javascript\">menu('m-penyewaan');</script>";
    private $header = "<script language=\"javascript\">menu('m-page');</script>";
    private $url = "karyawan/penyewaan";

    protected $modelPenghuni;
    protected $modelPenyewaan;
    protected $modelKamar;
    protected $helpers = ['form'];

    function __construct()
    {
        $this->modelPenyewaan = new ModelPenyewaan();
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

    public function sensor_bank($va_number)
    {
        $va_number = $va_number;
        $jmlSensor = 10;
        $afterVal = 0;
        $x = '';

        // untuk mengambil 4 digit angka di tengah nomor hp yang akan disensor
        $sensor = substr($va_number, $afterVal, $jmlSensor);

        //untuk memecah bagian / kelompok angka pertama dan terakhir
        $va_number2 = explode($sensor, $va_number);

        for ($i = 1; $i <= $jmlSensor; $i++) {
            $x .= 'X';
        }

        // untuk menggabungkan angka pertama dan terakhir dengan angka tengah yang sudah di sensor
        $newVa = $va_number2[0] . $x . $va_number2[1];

        // menampilkan hasil data yang disensor
        return $newVa;
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'penyewaan' => $this->modelPenyewaan->get_all(),
            'url'       => $this->url
        ];
        echo view('admin/penyewaan', $data) . $this->menu . $this->header;
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $cekData = $this->modelPenyewaan->find($id);

        if ($cekData) {
            $this->midtrans();
            $dataPenghuni = $this->modelPenghuni->find($cekData->id_penghuni);
            $dataKamar = $this->modelKamar->find($cekData->id_kamar);

            $status = \Midtrans\Transaction::status($cekData->order_id);

            $this->modelPenyewaan->update($id, [
                'transaction_status' => $status->transaction_status
            ]);

            $data = [
                'url'                   => $this->url,
                'no_invoice'            => $cekData->no_invoice,
                'tgl_penyewaan'         => $cekData->tgl_penyewaan,
                'lama_penyewaan'        => $cekData->lama_penyewaan,
                'payment_method'        => $cekData->payment_method,
                'transaction_status'    => $cekData->transaction_status,
                'bank'                  => $cekData->bank,
                'va_number'             =>  $this->sensor_bank($cekData->va_number),
                'tgl_penyewaan'         => date('d M, Y', strtotime($cekData->tgl_penyewaan)),
                'lama_penyewaan'        => $cekData->lama_penyewaan,
                'total_harga'           => number_format($cekData->total_harga, 0, ',', '.'),

                'nomor_kamar'           => $dataKamar->nomor_kamar,
                'harga_kamar'           => number_format($dataKamar->harga_kamar, 0, ',', '.'),

                'nama_penghuni'         => $dataPenghuni->nama_penghuni,
                'no_telp_penghuni'      => $dataPenghuni->no_telp_penghuni,
                'alamat_penghuni'       => $dataPenghuni->alamat_penghuni,


            ];

            return view('admin/penyewaan/cektransaksi', $data) . $this->menu . $this->header;
        } else {
            exit('Data tidak ditemukan');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id_penyewaan = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id_penyewaan = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id_penyewaan = null)
    {
        //
    }
}
