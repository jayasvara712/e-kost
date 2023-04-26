<?php

namespace App\Controllers\Admin;

use App\Models\ModelFasilitas;
use CodeIgniter\RESTful\ResourceController;

class Fasilitas extends ResourceController
{

    private $menu = "<script language=\"javascript\">menu('m-fasilitas');</script>";
    private $header = "<script language=\"javascript\">menu('m-master');</script>";
    private $url = "admin/fasilitas";
    protected $modelFasilitas;
    protected $helpers = ['form'];

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
        $data = [
            'fasilitas' => $this->modelFasilitas->findAll(),
            'url' => $this->url
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
        $data = [
            'url' => $this->url,
            'validation' => \config\Services::validation()
        ];
        echo view($this->url . '/add', $data) . $this->menu . $this->header;
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
            'judul_fasilitas' => [
                'rules'  => 'required|is_unique[fasilitas.judul_fasilitas]',
                'errors' => [
                    'required' => 'Masukan Judul Fasilitas!',
                    'is_unique' => 'Judul Fasilitas Sudah Terdaftar!'
                ]
            ],
        ]);

        if (!$validation) {
            $validation = \config\Services::validation();
            return redirect()->to(site_url($this->url . 'new'))->withInput()->with('validation', $validation);
        } else {

            $data = [
                'judul_fasilitas' => $post['judul_fasilitas']
            ];
            $this->modelFasilitas->insert($data);
            return redirect()->to(site_url($this->url))->with('success', 'Data Fasilitas Berhasil Ditambah');
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
        $data = [
            'url'           => $this->url,
            'fasilitas'     => $fasilitas,
            'validation'    => \Config\Services::validation()
        ];
        if (is_object($fasilitas)) {
            $data['fasilitas'] = $fasilitas;
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
    public function update($id_fasilitas = null)
    {
        $validation = $this->validate([
            'judul_fasilitas' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukan Judul Fasilitas!',
                ]
            ],
        ]);

        if (!$validation) {
            return redirect()->to(previous_url())->withInput()->with('error', $this->validator->getErrors());
        }

        $data = [
            'judul_fasilitas' => $this->request->getPost('judul_fasilitas')
        ];
        $this->modelFasilitas->update($id_fasilitas, $data);
        return redirect()->to(site_url($this->url))->with('success', 'Data Fasilitas Berhasil Dirubah');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id_fasilitas = null)
    {
        $this->modelFasilitas->where('id_fasilitas', $id_fasilitas)->delete();
        $json = [
            'success' => 'Data fasilitas berhasil dihapus!'
        ];
        echo json_encode($json);
    }
}
