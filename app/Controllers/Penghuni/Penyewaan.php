<?php

namespace App\Controllers\Penghuni;

use App\Models\ModelKamar;
use App\Models\ModelPenghuni;
use App\Models\ModelPenyewaan;
use CodeIgniter\RESTful\ResourceController;

class Penyewaan extends ResourceController
{
    private $menu = "<script language=\"javascript\">menu('m-penyewaan');</script>";
    private $header = "<script language=\"javascript\">menu('m-page');</script>";
    private $url = "penghuni/penyewaan";

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
        $no_invoice = $this->modelPenyewaan->noInvoice($tanggal)->getRowArray();
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

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'url'       => $this->url,
            'penyewaan' => $this->modelPenyewaan->getDetail(session()->id_penghuni)
        ];
        echo view($this->url, $data) . $this->menu . $this->header;
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

            return view($this->url . '/cektransaksi', $data) . $this->menu . $this->header;
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
        $data = [
            'url'       => $this->url,
            'no_invoice' => $this->invoice(),
            'penghuni' => $this->modelPenghuni->findAll(),
            'kamar' => $this->modelKamar->findAll(),
            'validation' => \Config\Services::validation()
        ];
        echo view($this->url . '/add', $data) . $this->menu . $this->header;
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $validation = $this->validate([
            'id_penghuni' => [
                'required',
                'errors' => [
                    'required' => "Nama Penghuni Tidak Boleh Kosong"
                ]
            ],
            'id_kamar' => [
                'required',
                'errors' => [
                    'required' => "Nomor Kamar Tidak Boleh Kosong"
                ]
            ],
            'tgl_penyewaan' => [
                'required',
                'errors' => [
                    'required' => "Tanggal Penyewaan Tidak Boleh Kosong"
                ]
            ],
            'lama_penyewaan' => [
                'required',
                'errors' => [
                    'required' => "Lama Penyewaan Tidak Boleh Kosong"
                ]
            ],
            'status_penyewaan' => [
                'required',
                'errors' => [
                    'required' => "Status Penyewaan Tidak Boleh Kosong"
                ]
            ]

        ]);

        if (!$validation) {
            return redirect()->to(previous_url())->withInput()->with('error', $this->validator->getErrors());
        } else {

            $data1 = [
                'id_penghuni' => $this->request->getPost('id_penghuni'),
                'id_kamar' => $this->request->getPost('id_kamar'),
                'tgl_penyewaan' => $this->request->getPost('tgl_penyewaan'),
                'lama_penyewaan' => $this->request->getPost('lama_penyewaan'),
                'status_penyewaan' => $this->request->getPost('status_penyewaan'),
            ];
            $this->modelPenyewaan->insert($data1);
            $id_kamar = $this->request->getPost('id_kamar');
            $data2 = [
                'status_kamar' => 'Tidak Tersedia'
            ];
            $this->modelKamar->update($id_kamar, $data2);
            return redirect()->to(site_url($this->url))->with('success', 'Data Penyewaan Berhasil Ditambah');
        }
    }

    public function payment()
    {
        $post = $this->request->getPost();
        if ($this->request->isAJAX()) {
            $no_invoice = $post['no_invoice'];
            $tgl_penyewaan = $post['tgl_penyewaan'];
            $id_penghuni = $post['id_penghuni'];
            $id_kamar = $post['id_kamar'];
            $lama_penyewaan  = $post['lama_penyewaan'];
            $total_harga = $post['total_harga'];
            $order_id = $post['order_id'];
            $payment_type = $post['payment_type'];
            $transaction_time = $post['transaction_time'];
            $transaction_status = $post['transaction_status'];
            $va_number = $post['va_number'];
            $bank = $post['bank'];

            $data1 = [
                'no_invoice' => $no_invoice,
                'tgl_penyewaan' => $tgl_penyewaan,
                'id_penghuni' => $id_penghuni,
                'id_kamar' => $id_kamar,
                'lama_penyewaan ' => $lama_penyewaan,
                'total_harga' => $total_harga,
                'order_id' => $order_id,
                'payment_method' => 'M',
                'payment_type' => $payment_type,
                'transaction_time' => $transaction_time,
                'transaction_status' => $transaction_status,
                'va_number' => $va_number,
                'bank' => $bank,
            ];
            $data2 = [
                'status_kamar' => 'Tidak Tersedia'
            ];
            $this->modelPenyewaan->insert($data1);
            $this->modelKamar->update($id_kamar, $data2);

            $json = [
                'success' => 'Transaksi Berhasil, silahkan lakukan pembayaran!'
            ];
            echo json_encode($json);
        }
    }

    public function payMidtrans()
    {

        if ($this->request->isAJAX()) {
            $post = $this->request->getPost();
            $no_invoice = $post['no_invoice'];
            $tgl_penyewaan = $post['tgl_penyewaan'];
            $id_penghuni = $post['id_penghuni'];
            $id_kamar = $post['id_kamar'];
            $nomor_kamar = $post['nomor_kamar'];
            $lama_penyewaan = $post['lama_penyewaan'];
            $harga_kamar = $post['harga_kamar'];
            $total_hagra = $post['total_harga'];
            $cekdata = $this->modelKamar->where('id_kamar', $id_kamar)->where('status_kamar', 'Tersedia')->first();

            if ($cekdata) {
                $penghuni = $this->modelPenghuni->where('id_penghuni', $id_penghuni)->first();
                $nama_penghuni = $penghuni->nama_penghuni;
                $no_telp_penghuni = $penghuni->no_telp_penghuni;

                // Set your Merchant Server Key
                \Midtrans\Config::$serverKey = getenv('midtrans_server_key');
                // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
                \Midtrans\Config::$isProduction = false;
                // Set sanitization on (default)
                \Midtrans\Config::$isSanitized = true;
                // Set 3DS transaction for credit card to true
                \Midtrans\Config::$is3ds = true;

                // Populate items
                $items = array(
                    array(
                        'id'       => $id_kamar,
                        'price'    => $harga_kamar,
                        'quantity' => $lama_penyewaan,
                        'name'     => 'Kamar No: ' . $nomor_kamar
                    )
                );

                // Populate customer's info
                $customer_details = array(
                    'first_name'       => $nama_penghuni,
                    'phone'            => $no_telp_penghuni,
                );

                $params = array(
                    'transaction_details' => array(
                        'order_id' => rand(),
                        'gross_amount' => $total_hagra,
                    ),
                    'item_details'        => $items,
                    'customer_details'    => $customer_details
                );

                $json = [
                    'no_invoice' => $no_invoice,
                    'tgl_penyewaan' => $tgl_penyewaan,
                    'id_penghuni' => $id_penghuni,
                    'id_kamar' => $id_kamar,
                    'lama_penyewaan' => $lama_penyewaan,
                    'total_harga' => $total_hagra,
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

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id_penyewaan = null)
    {
        $penyewaan = $this->modelPenyewaan->where('id_penyewaan', $id_penyewaan)->first();
        session();
        $data = [
            'penghuni' => $this->modelPenghuni->findAll(),
            'kamar' => $this->modelKamar->findAll(),
            'penyewaan' => $penyewaan,
            'validation' => \Config\Services::validation()
        ];
        if (is_object($penyewaan)) {
            $data['penyewaan'] = $penyewaan;
            echo view('admin/penyewaan/edit', $data) . $this->menu . $this->header;
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id_penyewaan = null)
    {
        $rules = [
            "id_penghuni" => "required",
            "id_kamar" => "required",
            "tgl_penyewaan" => "required",
            "lama_penyewaan" => "required",
            "status_penyewaan" => "required"
        ];

        $messages = [
            "id_penghuni" => [
                "required" => "Nama Penghuni Tidak Boleh Kosong"
            ],
            "id_kamar" => [
                "required" => "Nomor Kamar Tidak Boleh Kosong"
            ],
            "tgl_penyewaan" => [
                "required" => "Tanggal Penyewaan Tidak Boleh Kosong"
            ],
            "lama_penyewaan" => [
                "required" => "Lama Penyewaan Tidak Boleh Kosong"
            ],
            "status_penyewaan" => [
                "required" => "Status Penyewaan Tidak Boleh Kosong"
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->to(previous_url())->withInput()->with('error', $this->validator->getErrors());
        }

        $old_id_kamar = $this->request->getPost('old_id_kamar');
        $id_kamar = $this->request->getPost('id_kamar');

        $data = [
            'id_penghuni' => $this->request->getPost('id_penghuni'),
            'id_kamar' => $this->request->getPost('id_kamar'),
            'tgl_penyewaan' => $this->request->getPost('tgl_penyewaan'),
            'lama_penyewaan' => $this->request->getPost('lama_penyewaan'),
            'status_pembayaran' => $this->request->getPost('status_pembayaran'),
        ];
        $this->modelPenyewaan->update($id_penyewaan, $data);

        if ($old_id_kamar != $id_kamar) {
            $data1 = [
                'status_kamar' => 'Tidak Tersedia'
            ];
            $this->modelKamar->update($id_kamar, $data1);
            $data2 = [
                'status_kamar' => 'Tersedia'
            ];
            $this->modelKamar->update($old_id_kamar, $data2);
        }
        return redirect()->to(site_url('penyewaan'))->with('success', 'Data Penyewaan Berhasil Dirubah');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id_penyewaan = null)
    {
        $this->midtrans();
        $data = $this->modelPenyewaan->find($id_penyewaan);
        \Midtrans\Transaction::cancel($data->order_id);
        $data2 = [
            'status_kamar' => 'Tidak Tersedia'
        ];
        $this->modelKamar->update($data->id_kamar, $data2);
        $this->modelPenyewaan->where('id_penyewaan', $id_penyewaan)->delete();
        return redirect()->to(site_url('penyewaan'))->with('success', 'Data Penyewaan Berhasil Dihapus');
    }
}
