<?php

namespace App\Controllers;

use App\Models\ModelKamar;
use App\Models\ModelPenghuni;
use App\Models\ModelPenyewaan;
use App\Models\ModelPenyewaanDetail;
use App\Controllers\BaseController;
use App\Models\ModelDenah;
use App\Models\ModelFasilitas;
use App\Models\ModelTipeKamar;
use App\Models\ModelTipeKamarFasilitas;

class Home extends BaseController
{

    protected $modelPenghuni;
    protected $modelPenyewaan;
    protected $modelPenyewaanDetail;
    protected $modelKamar;
    protected $modelDenah;
    protected $modelFasilitas;
    protected $modelTipeKamarFasilitas;

    private $menu1 = "<script language=\"javascript\">menu('m-home');</script>";
    private $menu2 = "<script language=\"javascript\">menu('m-denah');</script>";

    function __construct()
    {
        $this->modelPenyewaan = new ModelPenyewaan();
        $this->modelPenyewaanDetail = new ModelPenyewaanDetail();
        $this->modelPenghuni = new ModelPenghuni();
        $this->modelKamar = new ModelKamar();
        $this->modelDenah = new ModelDenah();
        $this->modelFasilitas = new ModelFasilitas();
        $this->modelTipeKamarFasilitas = new ModelTipeKamarFasilitas();
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
            'lantai'        => $lantai_kamar
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

    public function kamar_detail($id_kamar)
    {
        $dataKamar = $this->modelKamar->getSpecify($id_kamar);
        $data = [
            'kamar'     => $dataKamar['kamar'],
            'fasilitas'     => $dataKamar['fasilitas'],
            'gambar'     => $dataKamar['gambar'],
        ];
        echo view('kamar_detail', $data) . $this->menu1;
    }

    public function temp_sewa()
    {
        $post = $this->request->getPost();
        $params = [
            'id_kamar'          => $post['id_kamar'],
            'nomor_kamar'       => $post['nomor_kamar'],
            'harga_kamar'       => $post['harga_kamar'],
            'tgl_penyewaan'     => $post['tgl_penyewaan'],
            'lama_penyewaan'    => $post['lama_penyewaan'],
            'payment_method'    => $post['payment_method'],
            'total_harga'       => $post['total_harga'],
            'temp_sewa'         => 'yes'
        ];
        session()->set($params);
        return redirect()->to(site_url('login'))->with('error', 'Harap login terlebih dahulu sebelum memesan!');
    }
}
