<?php

namespace App\Controllers\Admin;

use App\Models\ModelFasilitas;
use App\Models\ModelKamar;
use App\Models\ModelTipeKamar;
use App\Models\ModelTipeKamarFasilitas;
use App\Models\ModelTipeKamarGambar;
use CodeIgniter\RESTful\ResourceController;

class TipeKamar extends ResourceController
{
    private $menu = "<script language=\"javascript\">menu('m-tipekamar');</script>";
    private $header = "<script language=\"javascript\">menu('m-master');</script>";
    private $url = "admin/tipekamar";
    protected $modelFasilitas;
    protected $modelTipeKamar;
    protected $modelTipeKamarFasilitas;
    protected $modelTipeKamarGambar;
    protected $helpers = ['form'];

    function __construct()
    {
        $this->modelFasilitas = new ModelFasilitas();
        $this->modelTipeKamar = new ModelTipeKamar();
        $this->modelTipeKamarFasilitas = new ModelTipeKamarFasilitas();
        $this->modelTipeKamarGambar = new ModelTipeKamarGambar();
    }

    public function index()
    {
        $data = [
            'alert'         => 'Ingin menghapus data tipe kamar ? data yang terhubung dengan tipe kamar akan terhapus dan tidak bisa di kembalikan.',
            'dataTipeKamar'    => $this->modelTipeKamar->getAll_TipeKamar(),
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
        $image = $this->request->getFileMultiple('image');

        $validation = $this->validate([
            'judul_tipe_kamar' => [
                'rules'  => 'required|is_unique[tipe_kamar.judul_tipe_kamar]',
                'errors' => [
                    'required' => 'Masukan Judul Tipe Kamar!',
                    'is_unique' => 'Tipe Kamar Sudah Terdaftar!'
                ]
            ],
            'id_fasilitas' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Pilih Fasilitas Kamar!'
                ]
            ],
            'image' => [
                'rules'  => 'uploaded[image]|mime_in[image,image/png,image/jpeg,image/jpg,image/jfif]',
                'errors' => [
                    'uploaded' => 'Pilih Gambar Kamar!',
                    'mime_in'  => 'Tipe File salah!'
                ]
            ],

        ]);

        if (!$validation) {
            return redirect()->to(site_url($this->url . '/new'))->withInput()->with('error', '$this->validator->getErrors()');
        } else {
            $id_fasilitas = $post['id_fasilitas'];

            $data1 = [
                'judul_tipe_kamar' => $post['judul_tipe_kamar'],
            ];
            $id_tipe_kamar = $this->modelTipeKamar->simpan($data1);

            $data2 = [];
            foreach ($id_fasilitas as $key => $value) {
                array_push($data2, [
                    'id_tipe_kamar' => $id_tipe_kamar,
                    'id_fasilitas' => $value,
                ]);
            }
            $this->modelTipeKamarFasilitas->insertBatch($data2);

            $data3 = [];
            foreach ($image as $key => $value) {
                $new_name =  $value->getRandomName();
                array_push($data3, [
                    'id_tipe_kamar' => $id_tipe_kamar,
                    'image' => $new_name,
                ]);
                $value->move('uploads/kamar/', $new_name);
            }
            $this->modelTipeKamarGambar->insertBatch($data3);

            return redirect()->to(site_url($this->url))->with('success', 'Data Tipe Kamar Berhasil Ditambah');
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id_tipe_kamar = null)
    {
        $tipe_kamar = $this->modelTipeKamar->where('id_tipe_kamar', $id_tipe_kamar)->first();
        $id_fasilitas = $this->modelTipeKamarFasilitas->where('id_tipe_kamar', $id_tipe_kamar)->findAll();
        $dataImage = $this->modelTipeKamarGambar->where('id_tipe_kamar', $id_tipe_kamar)->findAll();

        foreach ($dataImage as $value) {
            $tempDataImage[] = $value->image;
        }
        $temp_image = implode(",", $tempDataImage);

        $data = [
            'url' => $this->url,
            'tipe_kamar' => $tipe_kamar,
            'fasilitas' => $this->modelFasilitas->findAll(),
            'temp_id_fasilitas' => $id_fasilitas,
            'temp_image' => $temp_image,
            'validation' => \Config\Services::validation()
        ];

        if (is_object($tipe_kamar)) {
            $data['tipe_kamar'] = $tipe_kamar;
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
    public function update($id_tipe_kamar = null)
    {
        $post = $this->request->getPost();
        $image = $this->request->getFileMultiple('image');

        $validation = $this->validate([
            'id_fasilitas' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Pilih Fasilitas Kamar!'
                ]
            ],

        ]);

        if (!$validation) {
            return redirect()->to(site_url($this->url . '/new'))->withInput()->with('error', '$this->validator->getErrors()');
        } else {
            $id_tipe_kamar = $post['id_tipe_kamar'];
            $id_fasilitas = $post['id_fasilitas'];

            $dataFasilitas = [];
            foreach ($id_fasilitas as $key => $value) {
                array_push($dataFasilitas, [
                    'id_tipe_kamar' => $id_tipe_kamar,
                    'id_fasilitas' => $value,
                ]);
            }
            $this->modelTipeKamarFasilitas->where('id_tipe_kamar', $id_tipe_kamar)->delete();
            $this->modelTipeKamarFasilitas->insertBatch($dataFasilitas);

            $dataGambar = [];
            if ($post['array_image']) {
                $deleteGambar = explode(',', $post['array_image']);
                foreach ($deleteGambar as $key => $value) {
                    unlink('uploads/kamar/' . $value);
                    $this->modelTipeKamarGambar->where('image', $value)->delete();
                }
            };

            if ($image[0]->getName() != '') {
                foreach ($image as $key => $value) {
                    $new_name =  $value->getRandomName();
                    array_push($dataGambar, [
                        'id_tipe_kamar' => $id_tipe_kamar,
                        'image' => $new_name,
                    ]);
                    $value->move('uploads/kamar/', $new_name);
                }
                $this->modelTipeKamarGambar->insertBatch($dataGambar);
            }

            return redirect()->to(site_url($this->url))->with('success', 'Data Tipe Kamar Berhasil Ditambah');
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id_tipe_kamar = null)
    {
        $gambar = $this->modelTipeKamarGambar->where('id_tipe_kamar', $id_tipe_kamar)->findAll();
        foreach ($gambar as $key => $value) {
            unlink('uploads/kamar/' . $value->image);
        }
        $this->modelTipeKamar->where('id_tipe_kamar', $id_tipe_kamar)->delete();
        $this->modelTipeKamarFasilitas->where('id_tipe_kamar', $id_tipe_kamar)->delete();
        $this->modelTipeKamarGambar->where('id_tipe_kamar', $id_tipe_kamar)->delete();
        $json = [
            'success' => 'Data Tipe kamar berhasil dihapus!'
        ];
        echo json_encode($json);
    }
}
