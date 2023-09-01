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

    public function index($role = null)
    {
        if ($role != null) {
            $sub_menu = "<script language=\"javascript\">menu('m-tiket-" . $role . "');</script>";
            if ($role == 'penyewa') {
                $data = [
                    'judul'     => ucwords($role),
                    'tiket'    => $this->modelTiket->getAllGroup($role),
                    'url'           => $this->url
                ];
            } else if ($role == 'karyawan') {
                $data = [
                    'judul'     => ucwords($role),
                    'tiket'    => $this->modelTiket->getAllGroup($role),
                    'url'           => $this->url
                ];
            }
            echo view($this->url, $data) . $this->menu . $sub_menu;
        } else {
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
        $sub_menu = "<script language=\"javascript\">menu('m-karyawan');</script>";
        $data = [
            'url'           => $this->url
        ];
        echo view($this->url . '/add', $data) . $this->menu . $sub_menu;
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
                'id_penghuni' => null,
                'id_karyawan' => $post['id_karyawan'],
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
            $url = 'karyawan/tiket/karyawan';

            return redirect()->to($url)->with('success', 'Tiket Berhasil Dibuat!');
        }
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
            return redirect()->back()->with('success', 'Status tiket berhasil diupdate');
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
