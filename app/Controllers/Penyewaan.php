<?php

namespace App\Controllers;

use App\Models\ModelKamar;
use App\Models\ModelPenghuni;
use App\Models\ModelPenyewaan;
use CodeIgniter\RESTful\ResourceController;

class Penyewaan extends ResourceController
{
    private $menu = "<script language=\"javascript\">menu('m-penyewaan');</script>";
    private $header = "<script language=\"javascript\">menu('m-page');</script>";
    function __construct()
    {
        $this->modelPenyewaan = new ModelPenyewaan();
        $this->modelPenghuni = new ModelPenghuni();
        $this->modelKamar = new ModelKamar();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data['penyewaan'] = $this->modelPenyewaan->get_all();
        echo view('admin/penyewaan', $data) . $this->menu . $this->header;
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        session();
        $data = [
            'penghuni' => $this->modelPenghuni->findAll(),
            'kamar' => $this->modelKamar->findAll(),
            'validation' => \Config\Services::validation()
        ];
        echo view('admin/penyewaan/add', $data) . $this->menu . $this->header;
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
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
            return redirect()->to(site_url('/penyewaan/new'))->withInput()->with('error', $this->validator->getErrors());
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
            return redirect()->to(site_url('penyewaan'))->with('success', 'Data Penyewaan Berhasil Ditambah');
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
        $this->modelPenyewaan->where('id_penyewaan', $id_penyewaan)->delete();
        return redirect()->to(site_url('penyewaan'))->with('success', 'Data Penyewaan Berhasil Dihapus');
    }
}
