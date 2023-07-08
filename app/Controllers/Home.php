<?php

namespace App\Controllers;

use App\Models\ModelKamar;
use App\Models\ModelPenghuni;
use App\Models\ModelPenyewaan;
use App\Models\ModelPenyewaanDetail;
use App\Controllers\BaseController;
use App\Models\ModelDenah;

class Home extends BaseController
{

    protected $modelPenghuni;
    protected $modelPenyewaan;
    protected $modelPenyewaanDetail;
    protected $modelKamar;
    protected $modelDenah;

    private $menu1 = "<script language=\"javascript\">menu('m-home');</script>";
    private $menu2 = "<script language=\"javascript\">menu('m-denah');</script>";

    function __construct()
    {
        $this->modelPenyewaan = new ModelPenyewaan();
        $this->modelPenyewaanDetail = new ModelPenyewaanDetail();
        $this->modelPenghuni = new ModelPenghuni();
        $this->modelKamar = new ModelKamar();
        $this->modelDenah = new ModelDenah();
    }

    public function index()
    {
        $params = [
            'url'       => 'home',
        ];
        session()->set($params);

        $lantai_kamar = '';
        $post = $this->request->getPost();
        if (isset($post['lantai_kamar'])) {
            $lantai_kamar = $post['lantai_kamar'];
        }

        $data = [
            'dataKamar'     => $this->modelKamar->getAll_Available_filter($lantai_kamar),
        ];

        echo view('index', $data) . $this->menu1;
    }

    public function denah()
    {
        $data = [
            'denah'    => $this->modelDenah->findAll(),
        ];
        echo view('denah', $data) . $this->menu2;
    }
}
