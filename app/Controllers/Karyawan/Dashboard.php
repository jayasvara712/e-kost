<?php

namespace App\Controllers\Karyawan;

use App\Models\ModelFasilitas;
use App\Models\ModelKamar;
use App\Models\ModelKaryawan;
use App\Models\ModelPenghuni;
use App\Models\ModelPenyewaan;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    private $menu = "<script language=\"javascript\">menu('m-dashboard');</script>";

    protected $kamar;
    protected $penghuni;
    protected $penyewaan;

    function __construct()
    {
        $this->kamar        = new ModelKamar();
        $this->penghuni     = new ModelPenghuni();
        $this->penyewaan    = new ModelPenyewaan();
    }

    public function index()
    {
        $data['kamar']      = $this->kamar->count_all();
        $data['penghuni']   = $this->penghuni->count_all();
        $data['penyewaan']  = $this->penyewaan->count_all();
        echo view('karyawan/dashboard', $data) . $this->menu;
    }
}
