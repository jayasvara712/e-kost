<?php

namespace App\Controllers\Penghuni;

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
    private $url = "penghuni/tiket";
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
            'tiket'    => $this->modelTiket->getAll(session('id_penghuni')),
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
        $data = [
            'url'           => $this->url
        ];
        echo view($this->url . '/add', $data) . $this->menu;
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $post = $this->request->getPost();

        $validation = $this->validate([
            'judul_tiket' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukan Judul Tiket!',
                ]
            ],
            'pesan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Pesan Kamar!'
                ]
            ],

        ]);

        if (!$validation) {
            return redirect()->to(site_url($this->url . '/new'))->withInput()->with('error', '$this->validator->getErrors()');
        } else {

            $data1 = [
                'id_penghuni' => $post['id_penghuni'],
                'id_karyawan' => null,
                'judul_tiket' => $post['judul_tiket'],
                'tgl_tiket'   => date('y-m-d'),
                'status_tiket'      => 'waiting',
            ];
            $id_tiket = $this->modelTiket->simpan($data1);

            $gambar = $this->request->getFile('gambar');
            if ($gambar->isValid()) {
                //upload  ke public folder
                $newName = $gambar->getRandomName();
                $gambar->move('uploads/tiket/' . $id_tiket, $newName);
            } else {
                $newName = '';
            }

            $data2 = [
                'id_tiket' => $id_tiket,
                'tgl_pesan' =>  date('y-m-d'),
                'pesan' => $post['pesan'],
                'user' => $post['user'],
                'gambar' => $newName
            ];
            $this->modelTiketDetail->insert($data2);

            return redirect()->to(site_url($this->url))->with('success', 'Tiket Berhasil Dibuat!');
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
