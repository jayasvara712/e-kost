<?php

namespace App\Controllers;

use App\Models\ModelPenghuni;
use App\Models\ModelUser;
use CodeIgniter\RESTful\ResourceController;

class Penghuni extends ResourceController
{
    private $menu = "<script language=\"javascript\">menu('m-penghuni');</script>";
    private $header = "<script language=\"javascript\">menu('m-page');</script>";
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
        $data['penghuni'] = $this->modelPenghuni->get_all();
        echo view('admin/penghuni', $data) . $this->menu . $this->header;
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
        echo view('admin/penghuni/add', $data) . $this->menu . $this->header;
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $rules = [
            "nama_penghuni" => "required",
            "tgl_lahir_penghuni" => "required",
            "tempat_lahir_penghuni" => "required",
            "nik_penghuni" => "required|is_unique[penghuni.nik_penghuni]",
            "jk_penghuni" => "required",
            "no_telp_penghuni" => "required|is_unique[penghuni.no_telp_penghuni]",
            "alamat_penghuni" => "required",
            "username" => "required|is_unique[user.username]",
            "email" => "required|is_unique[user.email]",
            "password" => "required",
            "conf_password" => "required|matches[password]"
        ];

        $messages = [
            "nama_penghuni" => [
                "required" => "Nama Lengkap Tidak Boleh Kosong"
            ],
            "tgl_lahir_penghuni" => [
                "required" => "Tanggal Lahir Tidak Boleh Kosong"
            ],
            "tempat_lahir_penghuni" => [
                "required" => "Tempat Lahir Tidak Boleh Kosong"
            ],
            "nik_penghuni" => [
                "required" => "Nomor Induk Kependudukan Tidak Boleh Kosong",
                "is_unique" => "Nomor Induk Kependudukan Sudah Terdaftar!"
            ],
            "jk_penghuni" => [
                "required" => "Jenis Kelamin Tidak Boleh Kosong"
            ],
            "no_telp_penghuni" => [
                "required" => "Nomor Telepon Tidak Boleh Kosong"
            ],
            "alamat_penghuni" => [
                "required" => "Alamat Tidak Boleh Kosong"
            ],
            "username" => [
                "required" => "Username Tidak Boleh Kosong",
                "is_unique" => " Username Sudah Terdaftar!"
            ],
            "email" => [
                "required" => "Email Tidak Boleh Kosong",
                "is_unique" => "Email Sudah Terdaftar!"
            ],
            "password" => [
                "required" => "Password Tidak Boleh Kosong"
            ],
            "conf_password" => [
                "required" => "Konrifmasi Password Tidak Boleh Kosong",
                "matches" => "Password Tidak Sama"
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->to(site_url('/penghuni/new'))->withInput()->with('error', $this->validator->getErrors());
        } else {

            $data1 = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'role' => $this->request->getPost('role'),
            ];
            $this->modelUser->insert($data1);
            $id_user = $this->modelUser->getInsertID();
            $data2 = [
                'nama_penghuni' => $this->request->getPost('nama_penghuni'),
                'tgl_lahir_penghuni' => $this->request->getPost('tgl_lahir_penghuni'),
                'tempat_lahir_penghuni' => $this->request->getPost('tempat_lahir_penghuni'),
                'nik_penghuni' => $this->request->getPost('nik_penghuni'),
                'jk_penghuni' => $this->request->getPost('jk_penghuni'),
                'no_telp_penghuni' => $this->request->getPost('no_telp_penghuni'),
                'alamat_penghuni' => $this->request->getPost('alamat_penghuni'),
                'id_user' => $id_user
            ];
            $this->modelPenghuni->insert($data2);
            return redirect()->to(site_url('penghuni'))->with('success', 'Data Penghuni Berhasil Ditambah');
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id_penghuni = null)
    {
        $penghuni = $this->modelPenghuni->where('id_penghuni', $id_penghuni)->first();
        session();
        $data = [
            'penghuni' => $penghuni,
            'validation' => \Config\Services::validation()
        ];
        if (is_object($penghuni)) {
            $data['penghuni'] = $penghuni;
            echo view('admin/penghuni/edit', $data) . $this->menu . $this->header;
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
        $validation = $this->validate([
            'nama_penghuni' => [
                'required',
                'errors' => [
                    'required' => 'Masukan Nama Lengkap Anda!'
                ]
            ],
            'tgl_lahir_penghuni' => [
                'required',
                'errors' => [
                    'required' => 'Tanggal Lahir Tidak Boleh Kosong!'
                ]
            ],
            'tempat_lahir_penghuni' => [
                'required',
                'errors' => [
                    'required' => 'Tempat Lahir Tidak Boleh Kosong!'
                ]
            ],
            'nik_penghuni' => [
                'required',
                'errors' => [
                    'required' => 'Nomor Induk Kependudukan Tidak Boleh Kosong!'
                ]
            ],
            'jk_penghuni' => [
                'required',
                'errors' => [
                    'required' => 'Pilih Jenis Kelamin!'
                ]
            ],
            'no_telp_penghuni' => [
                'required',
                'errors' => [
                    'required' => 'Nomor Telepon Wajib Diisi!'
                ]
            ],
            'alamat_penghuni' => [
                'required',
                'errors' => [
                    'required' => 'Alamat Wajib Diisi!'
                ]
            ]

        ]);

        if (!$validation) {
            return redirect()->to(previous_url())->withInput()->with('error', $this->validator->getErrors());
        }

        $data = [
            'nama_penghuni' => $this->request->getPost('nama_penghuni'),
            'tgl_lahir_penghuni' => $this->request->getPost('tgl_lahir_penghuni'),
            'tempat_lahir_penghuni' => $this->request->getPost('tempat_lahir_penghuni'),
            'nik_penghuni' => $this->request->getPost('nik_penghuni'),
            'jk_penghuni' => $this->request->getPost('jk_penghuni'),
            'no_telp_penghuni' => $this->request->getPost('no_telp_penghuni'),
            'alamat_penghuni' => $this->request->getPost('alamat_penghuni')
        ];
        $this->modelPenghuni->update($id_penghuni, $data);
        return redirect()->to(site_url('penghuni'))->with('success', 'Data Penghuni Berhasil Dirubah');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id_penghuni = null)
    {
        $data = $this->modelPenghuni->select('id_user')->where('id_penghuni', $id_penghuni)->first();
        $this->modelUser->where('id_user', $data->id_user)->delete();
        $this->modelPenghuni->where('id_penghuni', $id_penghuni)->delete();
        return redirect()->to(site_url('penghuni'))->with('success', 'Data Penghuni Berhasil Dihapus');
    }
}
