<?php

namespace App\Controllers\Karyawan;

use App\Models\ModelPenghuni;
use App\Models\ModelUser;
use CodeIgniter\RESTful\ResourceController;

class Penghuni extends ResourceController
{
    private $menu = "<script language=\"javascript\">menu('m-penghuni');</script>";
    private $header = "<script language=\"javascript\">menu('m-user');</script>";
    private $url = "karyawan/penghuni";

    protected $modelPenghuni;
    protected $modelUser;
    protected $helpers = ['form'];

    function __construct()
    {
        $this->modelPenghuni = new ModelPenghuni();
        $this->modelUser = new ModelUser();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'penghuni'      => $this->modelPenghuni->get_all(),
            'url'           => $this->url
        ];
        echo view($this->url, $data) . $this->menu . $this->header;
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
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id_penghuni = null)
    {
        $penghuni = $this->modelPenghuni->get_all_where($id_penghuni);
        $data = [
            'url'           => $this->url,
            'penghuni'      => $penghuni,
            'validation'    => \Config\Services::validation()
        ];
        if (is_object($penghuni)) {
            $data['penghuni'] = $penghuni;
            echo view($this->url . '/edit', $data) . $this->menu . $this->header;
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id_penghuni = null)
    {
        $post = $this->request->getPost();
        $validation = $this->validate([
            'nik_penghuni' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nomor KTP Tidak Boleh Kosong!'
                ]
            ],
            'nama_penghuni' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama Penghuni Tidak Boleh Kosong!'
                ]
            ],
            'no_telp_penghuni' => [
                'rules'  => 'required|min_length[10]|max_length[13]',
                'errors' => [
                    'required' => 'Nomor Telepon Penghuni Tidak Boleh Kosong!',
                    'min_length' => 'Nomor Telepon Minimal 10 Angka!',
                    'max_length' => 'Nomor Telepon Minimal 13 Angka!'
                ]
            ],
            'tempat_lahir_penghuni' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tempat Lahir Penghuni Tidak Boleh Kosong!'
                ]
            ],
            'tgl_lahir_penghuni' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Tanggal Lahir Penghuni Tidak Boleh Kosong!'
                ]
            ],
            'jk_penghuni' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin Penghuni Tidak Boleh Kosong!'
                ]
            ],
            'alamat_penghuni' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Alamat Penghuni Tidak Boleh Kosong!'
                ]
            ]
        ]);

        if (!$validation) {
            $validation = \config\Services::validation();
            return redirect()->to($this->url . '/edit/' . $id_penghuni)->withInput()->with('validation', $validation);
        } else {
            $data = [
                'nik_penghuni' => $post['nik_penghuni'],
                'nama_penghuni' => $post['nama_penghuni'],
                'no_telp_penghuni' => $post['no_telp_penghuni'],
                'tempat_lahir_penghuni' => $post['tempat_lahir_penghuni'],
                'tgl_lahir_penghuni' => $post['tgl_lahir_penghuni'],
                'jk_penghuni' => $post['jk_penghuni'],
                'alamat_penghuni' => $post['alamat_penghuni'],
            ];
            $this->modelPenghuni->update($id_penghuni, $data);
            return redirect()->to(site_url($this->url))->with('success', 'Data Penyewa Berhasil Dirubah!');
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id_penghuni = null)
    {
    }
}
