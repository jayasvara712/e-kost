<?php

namespace App\Controllers;

use App\Models\ModelKamar;
use App\Models\ModelPenghuni;
use App\Models\ModelPenyewaan;
use App\Models\ModelPenyewaanDetail;
use App\Controllers\BaseController;

class Home extends BaseController
{

    protected $modelPenghuni;
    protected $modelPenyewaan;
    protected $modelPenyewaanDetail;
    protected $modelKamar;

    private $menu = "<script language=\"javascript\">menu('m-home');</script>";

    function __construct()
    {
        $this->modelPenyewaan = new ModelPenyewaan();
        $this->modelPenyewaanDetail = new ModelPenyewaanDetail();
        $this->modelPenghuni = new ModelPenghuni();
        $this->modelKamar = new ModelKamar();
    }

    public function index()
    {
        $params = [
            'url'       => 'home',
        ];
        session()->set($params);
        $data = [
            'dataKamar'     => $this->modelKamar->getAll_Available(),
        ];
        echo view('index', $data) . $this->menu;
    }

    public function getKamar()
    {
        $lantai_kamarObj = $this->request->getPost('lantai_kamar');

        // cek lantai
        if ($lantai_kamarObj != null) {
            $lantai_kamar = $lantai_kamarObj;
        } else {
            $lantai_kamar = '';
        }

        $data = $this->modelKamar->getAll_Available_filter($lantai_kamar);
        echo json_encode($data);
    }
}
