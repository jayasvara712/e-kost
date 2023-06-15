<?php

namespace App\Controllers\Karyawan;

use App\Models\ModelKamar;
use App\Models\ModelTipeKamar;
use CodeIgniter\RESTful\ResourceController;

class Kamar extends ResourceController
{
    private $menu = "<script language=\"javascript\">menu('m-kamar');</script>";
    private $header = "<script language=\"javascript\">menu('m-master');</script>";
    private $url = "karyawan/kamar";
    protected $modelKamar;
    protected $modelTipeKamar;
    protected $helpers = ['form'];

    function __construct()
    {
        $this->modelKamar = new ModelKamar();
        $this->modelTipeKamar = new ModelTipeKamar();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'alert'     => 'Ingin menghapus data kamar ? data yang terhubung dengan kamar akan terhapus dan tidak bisa di kembalikan.',
            'dataKamar' => $this->modelKamar->getAll(),
            'url'       => $this->url
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
            'tipe_kamar'     => $this->modelTipeKamar->findAll()
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
            'nomor_kamar' => [
                'rules'  => 'required|is_unique[kamar.nomor_kamar]',
                'errors' => [
                    'required' => 'Masukan Nomor Kamar!',
                    'is_unique' => 'Nomor Kamar Sudah Terdaftar!'
                ]
            ],
            'harga_kamar' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukan Harga Kamar!'
                ]
            ],
            'id_tipe_kamar' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Pilih Tipe Kamar!'
                ]
            ],
            'status_kamar' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Pilih Status Kamar!'
                ]
            ]

        ]);

        if (!$validation) {
            return redirect()->to(site_url($this->url . '/new'))->withInput()->with('error', '$this->validator->getErrors()');
        } else {
            $harga_kamar = str_replace(',', '', $post['harga_kamar']);

            $data1 = [
                'id_tipe_kamar' => $post['id_tipe_kamar'],
                'nomor_kamar' => $post['nomor_kamar'],
                'harga_kamar' => $harga_kamar,
                'status_kamar' => $post['status_kamar'],
                'keterangan_kamar' => $post['keterangan_kamar']
            ];
            $this->modelKamar->insert($data1);
            return redirect()->to(site_url($this->url))->with('success', 'Data Kamar Berhasil Ditambah');
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
        $id_tipe_kamar = $this->modelTipeKamar->where('id_tipe_kamar', $kamar->id_tipe_kamar)->findAll();
        $data = [
            'url' => $this->url,
            'kamar' => $kamar,
            'tipe_kamar' => $this->modelTipeKamar->findAll(),
            'temp_tipe_kamar' => $id_tipe_kamar,
            'validation' => \Config\Services::validation()
        ];
        if (is_object($kamar)) {
            $data['kamar'] = $kamar;
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
    public function update($id_kamar = null)
    {
        $post = $this->request->getPost();
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
            'id_tipe_kamar' => [
                'required',
                'errors' => [
                    'required' => 'Pilih Tipe Kamar!'
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
        } else {
            $harga_kamar = str_replace(',', '', $post['harga_kamar']);

            $data1 = [
                'id_tipe_kamar' => $post['id_tipe_kamar'],
                'nomor_kamar' => $post['nomor_kamar'],
                'harga_kamar' => $harga_kamar,
                'status_kamar' => $post['status_kamar'],
                'keterangan_kamar' => $post['keterangan_kamar']
            ];
            $this->modelKamar->update($id_kamar, $data1);
            return redirect()->to(site_url($this->url))->with('success', 'Data Kamar Berhasil Dirubah');
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id_kamar = null)
    {
        $this->modelKamar->where('id_kamar', $id_kamar)->delete();
        $this->modelKamarDetail->where('id_kamar', $id_kamar)->delete();
        $json = [
            'success' => 'Data kamar berhasil dihapus!'
        ];
        echo json_encode($json);
    }

    public function detailKamar()
    {
        $id_kamar = $this->request->getPost('id_kamar');
        $kamar = $this->modelKamar->getDetail($id_kamar);

        $json = [
            'kamar' => $kamar[0]
        ];
        echo json_encode($json);
    }
}
