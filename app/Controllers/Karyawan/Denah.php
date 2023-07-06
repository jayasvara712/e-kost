<?php

namespace App\Controllers\Karyawan;

use App\Models\ModelDenah;
use CodeIgniter\RESTful\ResourceController;

class Denah extends ResourceController
{
    private $menu = "<script language=\"javascript\">menu('m-denah');</script>";
    private $header = "<script language=\"javascript\">menu('m-master');</script>";
    private $url = "karyawan/denah";
    protected $modelDenah;
    protected $helpers = ['form'];

    function __construct()
    {
        $this->modelDenah = new ModelDenah();
    }

    public function index()
    {
        $data = [
            'alert'         => 'Ingin menghapus data denah ? data akan terhapus dan tidak bisa di kembalikan.',
            'dataDenah'    => $this->modelDenah->findAll(),
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
        $data = [
            'url'           => $this->url,
            'validation'    => \Config\Services::validation(),
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
        $image_denah = $this->request->getFile('image_denah');

        $validation = $this->validate([
            'judul_denah' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Judul Denah!',
                ]
            ],
            'image_denah' => [
                'rules'  => 'uploaded[image_denah]|mime_in[image_denah,image/png,image/jpeg,image/jpg,image/jfif]',
                'errors' => [
                    'uploaded' => 'Pilih Gambar Kamar!',
                    'mime_in'  => 'Tipe File salah!'
                ]
            ],
            'deskripsi_denah' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Deskripsi Denah!'
                ]
            ],
        ]);

        if (!$validation) {
            return redirect()->to(site_url($this->url . '/new'))->withInput()->with('error', '$this->validator->getErrors()');
        } else {

            if ($image_denah->isValid()) {
                //upload  ke public folder
                $newName = $image_denah->getRandomName();
                $image_denah->move('uploads/denah/', $newName);
            } else {
                $newName = '';
            }

            $data = [
                'judul_denah' => $post['judul_denah'],
                'deskripsi_denah' => $post['deskripsi_denah'],
                'image_denah'         => $newName,
            ];
            $this->modelDenah->insert($data);

            return redirect()->to(site_url($this->url))->with('success', 'Data denah Berhasil Ditambah');
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id_denah = null)
    {
        $denah = $this->modelDenah->find($id_denah);
        $data = [
            'url'           => $this->url,
            'denah'      => $denah,
            'validation'    => \Config\Services::validation()
        ];
        if (is_object($denah)) {
            $data['denah'] = $denah;
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
    public function update($id_denah = null)
    {
        $post = $this->request->getPost();
        $image_denah = $this->request->getFile('image_denah');

        $validation = $this->validate([
            'judul_denah' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Judul Denah!',
                ]
            ],
            'image_denah' => [
                'rules'  => 'mime_in[image_denah,image/png,image/jpeg,image/jpg,image/jfif]',
                'errors' => [
                    'mime_in'  => 'Tipe File salah!'
                ]
            ],
            'deskripsi_denah' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Deskripsi Denah!'
                ]
            ],

        ]);

        if (!$validation) {
            $validation = \config\Services::validation();
            return redirect()->to($this->url . '/edit/' . $id_denah)->withInput()->with('validation', $validation);
        } else {

            if ($image_denah->getError() == 4) {
                $newName = $this->request->getPost('image_denah_lama');
            } else {
                $newName = $image_denah->getRandomName();
                $image_denah->move('uploads/denah/', $newName);
                //jika gambar default
                if ($this->request->getPost('image_denah_lama') != 'no-image.png') {
                    unlink('uploads/denah/' . $this->request->getPost('image_denah_lama'));
                }
            }

            $data = [
                'judul_denah' => $post['judul_denah'],
                'deskripsi_denah' => $post['deskripsi_denah'],
                'image_denah'         => $newName,
            ];
            $this->modelDenah->update($id_denah, $data);
            return redirect()->to($this->url)->with('success', 'Data Denah Berhasil Dirubah!');
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id_denah = null)
    {
        $data = $this->modelDenah->find($id_denah);
        unlink('uploads/denah/' . $data->image_denah);

        $this->modelDenah->where('id_denah', $id_denah)->delete();
        $json = [
            'success' => 'Data denah berhasil dihapus!'
        ];
        echo json_encode($json);
    }
}
