<?php

namespace App\Controllers\Admin;

use App\Models\ModelFasilitas;
use App\Models\ModelKamar;
use App\Models\ModelKamarDetail;
use CodeIgniter\RESTful\ResourceController;

class Kamar extends ResourceController
{
    private $menu = "<script language=\"javascript\">menu('m-kamar');</script>";
    private $header = "<script language=\"javascript\">menu('m-master');</script>";
    private $url = "admin/kamar";
    protected $modelKamar;
    protected $modelFasilitas;
    protected $modelKamarDetail;
    protected $helpers = ['form'];

    function __construct()
    {
        $this->modelKamar = new ModelKamar();
        $this->modelFasilitas = new ModelFasilitas();
        $this->modelKamarDetail = new ModelKamarDetail();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'alert'             => 'Ingin menghapus data kamar ? data yang terhubung dengan kamar akan terhapus dan tidak bisa di kembalikan.',
            'kamar'     => $this->modelKamar->getAll(),
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
            'fasilitas'     => $this->modelFasilitas->findAll()
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
            'id_fasilitas' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Pilih Fasilitas Kamar!'
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
            $id_fasilitas = $post['id_fasilitas'];
            $harga_kamar = str_replace(',', '', $post['harga_kamar']);

            $data1 = [
                'nomor_kamar' => $post['nomor_kamar'],
                'harga_kamar' => $harga_kamar,
                'status_kamar' => $post['status_kamar'],
                'keterangan_kamar' => $post['keterangan_kamar']
            ];
            $id_kamar = $this->modelKamar->simpan($data1);

            $data2 = [];
            foreach ($id_fasilitas as $key => $value) {
                array_push($data2, [
                    'id_kamar' => $id_kamar,
                    'id_fasilitas' => $value,
                ]);
            }

            $this->modelKamarDetail->insertBatch($data2);
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
        $id_fasilitas = $this->modelKamarDetail->where('id_kamar', $id_kamar)->findAll();
        $data = [
            'url' => $this->url,
            'kamar' => $kamar,
            'fasilitas' => $this->modelFasilitas->findAll(),
            'temp_id_fasilitas' => $id_fasilitas,
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
        } else {
            $id_fasilitas = $post['id_fasilitas'];
            $harga_kamar = str_replace(',', '', $post['harga_kamar']);

            $data1 = [
                'nomor_kamar' => $post['nomor_kamar'],
                'harga_kamar' => $harga_kamar,
                'status_kamar' => $post['status_kamar'],
                'keterangan_kamar' => $post['keterangan_kamar']
            ];
            $this->modelKamar->update($id_kamar, $data1);

            $data2 = [];
            foreach ($id_fasilitas as $key => $value) {
                array_push($data2, [
                    'id_kamar' => $id_kamar,
                    'id_fasilitas' => $value,
                ]);
            }
            $this->modelKamarDetail->where('id_kamar', $id_kamar)->delete();
            $this->modelKamarDetail->insertBatch($data2);
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
