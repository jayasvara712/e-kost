<?php

namespace App\Controllers;

use App\Models\ModelFasilitas;
use App\Models\ModelKamar;
use App\Models\ModelKaryawan;
use App\Models\ModelPenghuni;
use App\Models\ModelPenyewaan;
use CodeIgniter\RESTful\ResourceController;

class Dashboard extends ResourceController
{
    private $menu = "<script language=\"javascript\">menu('m-dashboard');</script>";

    protected $fasilitas;
    protected $kamar;
    protected $penghuni;
    protected $karyawan;
    protected $penyewaan;

    function __construct()
    {
        $this->fasilitas    = new ModelFasilitas();
        $this->kamar        = new ModelKamar();
        $this->penghuni     = new ModelPenghuni();
        $this->karyawan     = new ModelKaryawan();
        $this->penyewaan    = new ModelPenyewaan();
    }
    public function index()
    {
        $data['fasilitas']  = $this->fasilitas->count_all();
        $data['kamar']      = $this->kamar->count_all();
        $data['karyawan']   = $this->karyawan->count_all();
        $data['penghuni']   = $this->penghuni->count_all();
        $data['penyewaan']  = $this->penyewaan->count_all();
        echo view('admin/dashboard', $data) . $this->menu;
    }
}
