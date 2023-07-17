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

    public function index($role = null)
    {
        if($role != null){
            $sub_menu = "<script language=\"javascript\">menu('m-tiket-".$role."');</script>";
            if($role == 'penyewa'){
                $data = [
                    'judul'     =>ucwords($role),
                    'tiket'    => $this->modelTiket->getAllGroup($role),
                    'url'           => $this->url
                ];
            }else if($role =='karyawan'){
                $data = [
                    'judul'     =>ucwords($role),
                    'tiket'    => $this->modelTiket->getAllGroup($role),
                    'url'           => $this->url
                ];
            }
            echo view($this->url, $data) . $this->menu . $sub_menu;
        }else{
            echo 'Halaman Tidak Ditemukan';
        }
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

    public function update($id_tiket = null)
    {
        if ($id_tiket != null) {
            $post = $this->request->getPost();
            $data = [
                'status_tiket' => $post['status_tiket'],
            ];
            $this->modelTiket->update($id_tiket, $data);
            $url = "admin/tiket/karyawan";
            return redirect()->to(site_url($url))->with('success', 'Tiket Berhasil Di ambil');
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
