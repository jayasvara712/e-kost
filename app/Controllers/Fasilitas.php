<?php

namespace App\Controllers;

use App\Models\ModelFasilitas;
use CodeIgniter\RESTful\ResourceController;

class Fasilitas extends ResourceController
{

    private $menu = "<script language=\"javascript\">menu('m-fasilitas');</script>";
    private $header = "<script language=\"javascript\">menu('m-page');</script>";
    function __construct()
    {
        $this->modelFasilitas = new ModelFasilitas();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data['fasilitas'] = $this->modelFasilitas->findAll();
        echo view('admin/fasilitas', $data) . $this->menu . $this->header;
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
        echo view('admin/fasilitas/add', $data) . $this->menu . $this->header;
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $validation = $this->validate([
            'judul_fasilitas' => [
                'required',
                'errors' => [
                    'required' => 'Masukan Judul Fasilitas!'
                ]
            ]

        ]);

        if (!$validation) {
            return redirect()->to(site_url('/fasilitas/new'))->withInput()->with('error', $this->validator->getErrors());
        } else {

            $data = [
                'judul_fasilitas' => $this->request->getPost('judul_fasilitas')
            ];
            $this->modelFasilitas->insert($data);
            return redirect()->to(site_url('fasilitas'))->with('success', 'Data Fasilitas Berhasil Ditambah');
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id_fasilitas = null)
    {
        $fasilitas = $this->modelFasilitas->where('id_fasilitas', $id_fasilitas)->first();
        session();
        $data = [
            'fasilitas' => $fasilitas,
            'validation' => \Config\Services::validation()
        ];
        if (is_object($fasilitas)) {
            $data['fasilitas'] = $fasilitas;
            echo view('admin/fasilitas/edit', $data) . $this->menu . $this->header;
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id_fasilitas = null)
    {
        $validation = $this->validate([
            'judul_fasilitas' => [
                'required',
                'errors' => [
                    'required' => 'Masukan Judul Fasilitas!'
                ]
            ]

        ]);
        // 'Galeri/edit/' . $this->request->getPost('slug_k')
        if (!$validation) {
            return redirect()->to(previous_url())->withInput()->with('error', $this->validator->getErrors());
        }

        $data = [
            'judul_fasilitas' => $this->request->getPost('judul_fasilitas')
        ];
        $this->modelFasilitas->update($id_fasilitas, $data);
        return redirect()->to(site_url('fasilitas'))->with('success', 'Data Fasilitas Berhasil Dirubah');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id_fasilitas = null)
    {
        $this->modelFasilitas->where('id_fasilitas', $id_fasilitas)->delete();
        return redirect()->to(site_url('fasilitas'))->with('success', 'Data Fasilitas Berhasil Dihapus');
    }
}
