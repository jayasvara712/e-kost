<?php

namespace App\Controllers;

use App\Models\ModelKamar;
use CodeIgniter\RESTful\ResourceController;

class Kamar extends ResourceController
{
    private $menu = "<script language=\"javascript\">menu('m-kamar');</script>";
    private $header = "<script language=\"javascript\">menu('m-page');</script>";
    function __construct()
    {
        $this->modelKamar = new ModelKamar();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data['kamar'] = $this->modelKamar->findAll();
        echo view('admin/kamar', $data) . $this->menu . $this->header;
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
        session();
        $data = [
            'validation' => \Config\Services::validation()
        ];
        echo view('admin/kamar/add', $data) . $this->menu . $this->header;
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $validation = $this->validate([
            'nomor_kamar' => [
                'required',
                'errors' => [
                    'required' => 'Masukan Nomor Kamar!'
                ]
            ],
            'harga_kamar' => [
                'required',
                'errors' => [
                    'required' => 'Masukan Harga Kamar!'
                ]
            ],
            'id_fasilitas' => [
                'required',
                'errors' => [
                    'required' => 'Pilih Fasilitas Kamar!'
                ]
            ],
            'status_kamar' => [
                'required',
                'errors' => [
                    'required' => 'Pilih Status Kamar!'
                ]
            ]

        ]);

        if (!$validation) {
            return redirect()->to(site_url('/kamar/new'))->withInput()->with('error', '$this->validator->getErrors()');
        } else {

            $data = [
                'nomor_kamar' => $this->request->getPost('nomor_kamar'),
                'harga_kamar' => $this->request->getPost('harga_kamar'),
                'id_fasilitas' => $this->request->getPost('id_fasilitas'),
                'status_kamar' => $this->request->getPost('status_kamar'),
                'keterangan_kamar' => $this->request->getPost('keterangan_kamar')
            ];
            $this->modelKamar->insert($data);
            return redirect()->to(site_url('kamar'))->with('success', 'Data Kamar Berhasil Ditambah');
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id_kamar = null)
    {
        $kamar = $this->modelKamar->where('id_kamar', $id_kamar)->first();
        session();
        $data = [
            'kamar' => $kamar,
            'validation' => \Config\Services::validation()
        ];
        if (is_object($kamar)) {
            $data['kamar'] = $kamar;
            echo view('admin/kamar/edit', $data) . $this->menu . $this->header;
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id_kamar = null)
    {
        $validation = $this->validate([
            'nomor_kamar' => [
                'required',
                'errors' => [
                    'required' => 'Masukan Nomor Kamar!'
                ]
            ],
            'harga_kamar' => [
                'required',
                'errors' => [
                    'required' => 'Masukan Harga Kamar!'
                ]
            ],
            'id_fasilitas' => [
                'required',
                'errors' => [
                    'required' => 'Pilih Fasilitas Kamar!'
                ]
            ],
            'status_kamar' => [
                'required',
                'errors' => [
                    'required' => 'Pilih Status Kamar!'
                ]
            ]

        ]);

        if (!$validation) {
            return redirect()->to(previous_url())->withInput()->with('error', $this->validator->getErrors());
        }

        $data = [
            'nomor_kamar' => $this->request->getPost('nomor_kamar'),
            'harga_kamar' => $this->request->getPost('harga_kamar'),
            'id_fasilitas' => $this->request->getPost('id_fasilitas'),
            'status_kamar' => $this->request->getPost('status_kamar'),
            'keterangan_kamar' => $this->request->getPost('keterangan_kamar')
        ];
        $this->modelKamar->update($id_kamar, $data);
        return redirect()->to(site_url('kamar'))->with('success', 'Data Kamar Berhasil Dirubah');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id_kamar = null)
    {
        $this->modelKamar->where('id_kamar', $id_kamar)->delete();
        return redirect()->to(site_url('kamar'))->with('success', 'Data Kamar Berhasil Dihapus');
    }
}
