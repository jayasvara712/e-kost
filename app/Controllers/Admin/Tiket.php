<?php

namespace App\Controllers\Admin;

use App\Models\ModelFasilitas;
use App\Models\ModelKamar;
use App\Models\ModelTiket;
use App\Models\ModelTiketDetail;
use App\Models\ModelTipeKamar;
use App\Models\ModelTipeKamarFasilitas;
use App\Models\ModelTipeKamarGambar;
use CodeIgniter\RESTful\ResourceController;

class Tiket extends ResourceController
{
    private $menu = "<script language=\"javascript\">menu('m-ticket');</script>";
    private $url = "admin/tiket";
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
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id_kamar = null)
    {
        //
    }
}
