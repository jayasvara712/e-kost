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

    function __construct()
    {
        $this->modelPenyewaan = new ModelPenyewaan();
        $this->modelPenyewaanDetail = new ModelPenyewaanDetail();
        $this->modelPenghuni = new ModelPenghuni();
        $this->modelKamar = new ModelKamar();
    }

    public function index()
    {
        $data = [
            'dataKamar'     => $this->modelKamar->getAll_Available(),
        ];
        echo view('index', $data);
    }
}
