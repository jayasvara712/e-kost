<?php

namespace App\Controllers\Karyawan;

use App\Models\ModelTiket;
use App\Models\ModelTiketDetail;
use CodeIgniter\RESTful\ResourceController;

class TiketDetail extends ResourceController
{
    private $menu = "<script language=\"javascript\">menu('m-ticket');</script>";
    private $url = "karyawan/tiketdetail";
    protected $modelTiket;
    protected $modelTiketDetail;
    protected $helpers = ['form'];

    function __construct()
    {
        $this->modelTiket = new ModelTiket();
        $this->modelTiketDetail = new ModelTiketDetail();
    }

    public function index()
    {
        // 
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id_tiket = null)
    {
        $dataTiket = $this->modelTiketDetail->getAll($id_tiket);
        $data = [
            'id_tiket'    => $id_tiket,
            'tiket_detail'    => $dataTiket,
            'judul_tiket'   => $dataTiket[0]->judul_tiket,
            'status_tiket'   => $dataTiket[0]->status_tiket,
            'url'           => $this->url
        ];
        echo view($this->url, $data) . $this->menu;
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
    public function edit($id_tiket = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id_tiket = null)
    {
        $validation = $this->validate([
            'pesan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Pesan!',
                ]
            ],
        ]);

        if (!$validation) {
            return redirect()->to(previous_url())->withInput()->with('error', $this->validator->getErrors());
        }

        $gambar = $this->request->getFile('gambar');
        if ($gambar->isValid()) {
            //upload  ke public folder
            $newName = $gambar->getRandomName();
            $gambar->move('uploads/tiket/' . $id_tiket, $newName);
        }

        $data = [
            'id_tiket' => $this->request->getPost('id_tiket'),
            'user' => $this->request->getPost('user'),
            'tgl_pesan' =>  date('y-m-d'),
            'pesan' => $this->request->getPost('pesan'),
        ];
        $this->modelTiketDetail->insert($data);
        return redirect()->to(site_url($this->url . '/show/' . $id_tiket))->with('success', 'Pesan berhasil dikirim!');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id_kamar = null)
    {
        //
    }
}
