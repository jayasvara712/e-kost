<?php

namespace App\Controllers\Karyawan;

use App\Models\ModelTiket;
use App\Models\ModelTiketDetail;
use CodeIgniter\RESTful\ResourceController;

class Tiket extends ResourceController
{
    private $menu = "<script language=\"javascript\">menu('m-ticket');</script>";
    private $url = "karyawan/tiket";
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
        $data = [
            'tiket'    => $this->modelTiket->findAll(),
            'url'           => $this->url
        ];
        echo view($this->url, $data) . $this->menu;
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
    public function edit($id_fasilitas = null)
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
        if ($id_tiket != null) {
            $post = $this->request->getPost();
            $data = [
                'id_karyawan' => $post['id_karyawan'],
                'status_tiket' => $post['status_tiket'],
            ];
            $this->modelTiket->update($id_tiket, $data);
            return redirect()->to(site_url($this->url))->with('success', 'Tiket Berhasil Di ambil');
        }
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
