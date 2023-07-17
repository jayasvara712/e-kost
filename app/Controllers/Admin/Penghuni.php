<?php

namespace App\Controllers\Admin;

use App\Models\ModelPenghuni;
use App\Models\ModelUser;
use CodeIgniter\RESTful\ResourceController;

class Penghuni extends ResourceController
{
    private $menu = "<script language=\"javascript\">menu('m-penghuni');</script>";
    private $header = "<script language=\"javascript\">menu('m-user');</script>";
    private $url = "admin/penghuni";

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
            'alert'             => 'Ingin menghapus data penyewa ? data yang terhubung akan terhapus dan tidak bisa di kembalikan.',
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
        $foto_ktp = $this->request->getFile('foto_ktp');

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
            'no_telp_penghuni' => [
                'rules'  => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Nomor Telepon Penghuni Tidak Boleh Kosong!',
                    'min_length' => 'Nomor Telepon Minimal 10 Angka!',
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
            ],
            'foto_ktp' => [
                'rules'  => 'uploaded[foto_ktp]|mime_in[foto_ktp,image/png,image/jpeg,image/jpg,image/jfif]',
                'errors' => [
                    'uploaded' => 'Pilih Gambar Kamar!',
                    'mime_in'  => 'Tipe File salah!'
                ]
            ],
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

            if ($foto_ktp->isValid()) {
                //upload  ke public folder
                $newName = $foto_ktp->getRandomName();
                $foto_ktp->move('uploads/ktp/', $newName);
            } else {
                $newName = '';
            }

            $data2 = [
                'nik_penghuni' => $post['nik_penghuni'],
                'nama_penghuni' => $post['nama_penghuni'],
                'no_telp_penghuni' => $post['no_telp_penghuni'],
                'tempat_lahir_penghuni' => $post['tempat_lahir_penghuni'],
                'tgl_lahir_penghuni' => $post['tgl_lahir_penghuni'],
                'jk_penghuni' => $post['jk_penghuni'],
                'alamat_penghuni' => $post['alamat_penghuni'],
                'foto_ktp'  => $newName,
                'id_user' => $id_user
            ];
            $this->modelPenghuni->insert($data2);
            return redirect()->to($this->url)->with('success', 'Berhasil Menambahkan Data Penyewa!');
        }
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
        $foto_ktp = $this->request->getFile('foto_ktp');

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
            ],
            'foto_ktp' => [
                'rules'  => 'mime_in[foto_ktp,image/png,image/jpeg,image/jpg,image/jfif]',
                'errors' => [
                    'mime_in'  => 'Tipe File salah!'
                ]
            ],
        ]);

        if (!$validation) {
            $validation = \config\Services::validation();
            return redirect()->to($this->url . '/edit/' . $id_penghuni)->withInput()->with('validation', $validation);
        } else {

            $id_user = $post['id_user'];
            $data1 = [
                'username' => $post['username'],
                'email' => $post['email'],
                'password' => password_hash($post['password'], PASSWORD_BCRYPT),
                'role' => $post['role'],
            ];
            $this->modelUser->update($id_user, $data1);

            if ($foto_ktp->getError() == 4) {
                $newName = $this->request->getPost('foto_ktp_lama');
            } else {
                $newName = $foto_ktp->getRandomName();
                $foto_ktp->move('uploads/ktp/', $newName);
                //jika gambar default
                if ($this->request->getPost('foto_lama') != 'no-image.png') {
                    unlink('uploads/ktp/' . $this->request->getPost('foto_ktp_lama'));
                }
            }

            $data2 = [
                'nik_penghuni' => $post['nik_penghuni'],
                'nama_penghuni' => $post['nama_penghuni'],
                'no_telp_penghuni' => $post['no_telp_penghuni'],
                'tempat_lahir_penghuni' => $post['tempat_lahir_penghuni'],
                'tgl_lahir_penghuni' => $post['tgl_lahir_penghuni'],
                'jk_penghuni' => $post['jk_penghuni'],
                'alamat_penghuni' => $post['alamat_penghuni'],
                'foto_ktp' => $newName,
                'id_user' => $id_user
            ];
            $this->modelPenghuni->update($id_penghuni, $data2);
            return redirect()->to($this->url)->with('success', 'Data Penyewa Berhasil Dirubah!');
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id_penghuni = null)
    {
        $data = $this->modelPenghuni->select('id_user, foto_ktp')->where('id_penghuni', $id_penghuni)->first();
        unlink('uploads/ktp/' . $data->foto_ktp);

        $this->modelPenghuni->where('id_penghuni', $id_penghuni)->delete();
        $this->modelUser->where('id_user', $data->id_user)->delete();
        $json = [
            'success' => 'Data Penyewa berhasil dihapus!'
        ];
        echo json_encode($json);
    }
}
