<?php

namespace App\Controllers\Admin;

use App\Models\ModelKaryawan;
use App\Models\ModelUser;
use CodeIgniter\RESTful\ResourceController;

class Karyawan extends ResourceController
{

    private $menu = "<script language=\"javascript\">menu('m-karyawan');</script>";
    private $header = "<script language=\"javascript\">menu('m-user');</script>";
    private $url = "admin/karyawan";

    protected $ModelKaryawan;
    protected $modelUser;
    protected $helpers = ['form'];

    function __construct()
    {
        $this->ModelKaryawan = new ModelKaryawan();
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
            'alert'             => 'Ingin menghapus data karyawan ? data yang terhubung dengan karyawan akan terhapus dan tidak bisa di kembalikan.',
            'karyawan'      => $this->ModelKaryawan->get_all(),
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
            'validation'    => \Config\Services::validation()
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
            'nik_karyawan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nomor KTP Tidak Boleh Kosong!'
                ]
            ],
            'nama_karyawan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama karyawan Tidak Boleh Kosong!'
                ]
            ],
            'username' => [
                'rules'  => 'required|is_unique[user.username]',
                'errors' => [
                    'required' => 'Username Tidak Boleh Kosong!',
                    'is_unique' => 'Username Sudah Terdaftar!'
                ]
            ],
            'email' => [
                'rules'  => 'required|is_unique[user.email]',
                'errors' => [
                    'required' => 'Email Tidak Boleh Kosong!',
                    'is_unique' => 'Email Sudah Terdaftar!'
                ]
            ],
            'password' => [
                'rules'  => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password Tidak Boleh Kosong!',
                    'min_length' => 'Password Minimal 8 Huruf',

                ]
            ],
            'password_conf' => [
                'rules'  => 'required|min_length[8]|matches[password]',
                'errors' => [
                    'required' => 'Password Tidak Boleh Kosong!',
                    'min_length' => 'Password minimal 8 Huruf',
                    'matches'   => 'Password Tidak Sama',

                ]
            ],
            'no_telp_karyawan' => [
                'rules'  => 'required|min_length[10]|max_length[13]',
                'errors' => [
                    'required' => 'Nomor Telepon karyawan Tidak Boleh Kosong!',
                    'min_length' => 'Nomor Telepon Minimal 10 Angka!',
                    'max_length' => 'Nomor Telepon Minimal 13 Angka!'
                ]
            ],
            'jk_karyawan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin karyawan Tidak Boleh Kosong!'
                ]
            ],
            'alamat_karyawan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Alamat karyawan Tidak Boleh Kosong!'
                ]
            ]
        ]);

        if (!$validation) {
            $validation = \config\Services::validation();
            return redirect()->to($this->url . '/new')->withInput()->with('validation', $validation);
        } else {

            $data1 = [
                'username' => $post['username'],
                'email' => $post['email'],
                'password' => password_hash($post['password'], PASSWORD_BCRYPT),
                'role' => $post['role'],
            ];
            $id_user = $this->modelUser->register($data1);
            $data2 = [
                'nik_karyawan' => $post['nik_karyawan'],
                'nama_karyawan' => $post['nama_karyawan'],
                'no_telp_karyawan' => $post['no_telp_karyawan'],
                'jk_karyawan' => $post['jk_karyawan'],
                'alamat_karyawan' => $post['alamat_karyawan'],
                'id_user' => $id_user
            ];
            $this->ModelKaryawan->insert($data2);
            return redirect()->to($this->url)->with('success', 'Berhasil Menambahkan Data karyawan!');
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id_karyawan = null)
    {
        $karyawan = $this->ModelKaryawan->get_all_where($id_karyawan);
        $data = [
            'url'           => $this->url,
            'karyawan'      => $karyawan,
            'validation'    => \Config\Services::validation()
        ];
        if (is_object($karyawan)) {
            $data['karyawan'] = $karyawan;
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
    public function update($id_karyawan = null)
    {
        $post = $this->request->getPost();
        $validation = $this->validate([
            'nik_karyawan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nomor KTP Tidak Boleh Kosong!'
                ]
            ],
            'nama_karyawan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama karyawan Tidak Boleh Kosong!'
                ]
            ],
            'username' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Username Tidak Boleh Kosong!',
                ]
            ],
            'email' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Email Tidak Boleh Kosong!',
                ]
            ],
            'password' => [
                'rules'  => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password Tidak Boleh Kosong!',
                    'min_length' => 'Password Minimal 8 Huruf',

                ]
            ],
            'password_conf' => [
                'rules'  => 'required|min_length[8]|matches[password]',
                'errors' => [
                    'required' => 'Password Tidak Boleh Kosong!',
                    'min_length' => 'Password minimal 8 Huruf',
                    'matches'   => 'Password Tidak Sama',

                ]
            ],
            'no_telp_karyawan' => [
                'rules'  => 'required|min_length[10]|max_length[13]',
                'errors' => [
                    'required' => 'Nomor Telepon karyawan Tidak Boleh Kosong!',
                    'min_length' => 'Nomor Telepon Minimal 10 Angka!',
                    'max_length' => 'Nomor Telepon Minimal 13 Angka!'
                ]
            ],
            'jk_karyawan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin karyawan Tidak Boleh Kosong!'
                ]
            ],
            'alamat_karyawan' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Alamat karyawan Tidak Boleh Kosong!'
                ]
            ]
        ]);

        if (!$validation) {
            $validation = \config\Services::validation();
            return redirect()->to($this->url . '/edit/' . $id_karyawan)->withInput()->with('validation', $validation);
        } else {

            $id_user = $post['id_user'];
            $data1 = [
                'username' => $post['username'],
                'email' => $post['email'],
                'password' => password_hash($post['password'], PASSWORD_BCRYPT),
                'role' => $post['role'],
            ];
            $this->modelUser->update($id_user, $data1);
            $data2 = [
                'nik_karyawan' => $post['nik_karyawan'],
                'nama_karyawan' => $post['nama_karyawan'],
                'no_telp_karyawan' => $post['no_telp_karyawan'],
                'jk_karyawan' => $post['jk_karyawan'],
                'alamat_karyawan' => $post['alamat_karyawan'],
                'id_user' => $id_user
            ];
            $this->ModelKaryawan->update($id_karyawan, $data2);
            return redirect()->to($this->url)->with('success', 'Data Penhuni Berhasil Dirubah!');
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id_karyawan = null)
    {
        $data = $this->ModelKaryawan->select('id_user')->where('id_karyawan', $id_karyawan)->first();
        $this->modelUser->where('id_user', $data->id_user)->delete();
        $this->ModelKaryawan->where('id_karyawan', $id_karyawan)->delete();
        $json = [
            'success' => 'Data karyawan berhasil dihapus!'
        ];
        echo json_encode($json);
    }
}
