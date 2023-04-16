<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKaryawan;
use App\Models\ModelPenghuni;
use App\Models\ModelUser;

class Auth extends BaseController
{
    protected $user;
    protected $penghuni;
    protected $karyawan;
    protected $helpers = ['form'];
    function __construct()
    {
        $this->user = new ModelUser();
        $this->penghuni = new ModelPenghuni();
        $this->karyawan = new ModelKaryawan();
    }

    public function index()
    {
        return redirect()->to(site_url('login'));
    }

    public function login()
    {
        if (session('id_user')) {
            return redirect()->to(site_url('dashboard'));
        }
        return view('auth/login');
    }

    public function loginProcess()
    {
        $post = $this->request->getPost();
        $query = $this->user->getWhere(['email' => $post['email']]);
        $user = $query->getRow();

        if ($user) {
            if (password_verify($post['password'], $user->password)) {
                if ($user->role == 'admin') {
                    $params = [
                        'id_user'       => $user->id_user,
                        'username'      => $user->username,
                        'name'          => $user->username,
                        'role'          => $user->role,
                        'isLoggedIn'    => true
                    ];
                    session()->set($params);
                    return redirect()->to(site_url('dashboard'))->with('success', 'Selamat Datang, anda login sebagai Admin');
                } else if ($user->role == 'penghuni') {
                    $query = $this->penghuni->getWhere(['id_user' => $user->id_user]);
                    $penghuni = $query->getRow();
                    $params = [
                        'id_user'       => $user->id_user,
                        'username'      => $user->username,
                        'name'          => $penghuni->nama_penghuni,
                        'role'          => $user->role,
                        'isLoggedIn'    => true
                    ];
                    session()->set($params);
                    return redirect()->to(site_url('dashboard'))->with('success', 'Selamat Datang, anda login sebagai Penghuni');
                } else if ($user->role == 'karyawan') {
                    $query = $this->karyawan->getWhere(['id_user' => $user->id_user]);
                    $karyawan = $query->getRow();
                    $params = [
                        'id_user'       => $user->id_user,
                        'username'      => $user->username,
                        'name'          => $karyawan->nama_karyawan,
                        'role'          => $user->role,
                        'isLoggedIn'    => true
                    ];
                    session()->set($params);
                    return redirect()->to(site_url('dashboard'))->with('success', 'Selamat Datang, anda login sebagai Karyawan');
                }
            } else {
                return redirect()->to(site_url('login'))->with('error', 'Password tidak sesuai');
            }
        } else {
            return redirect()->to(site_url('login'))->with('error', 'User Tidak Ditemukan');
        }
    }

    public function register()
    {
        $data = [
            'title' => 'Register E-Kost',
            'validation' => \config\Services::validation()
        ];
        return view('auth/register', $data);
    }

    public function registerProcess()
    {
        $post = $this->request->getPost();
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
            'agree' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Anda harus menyetujui syarat dan ketentuan!'
                ]
            ],
        ]);

        if (!$validation) {
            $validation = \config\Services::validation();
            return redirect()->to('/register')->withInput()->with('validation', $validation);
        } else {

            $data1 = [
                'username' => $post['username'],
                'email' => $post['email'],
                'password' => password_hash($post['password'], PASSWORD_BCRYPT),
                'role' => $post['role'],
            ];
            $id_user = $this->user->register($data1);
            $data2 = [
                'nik_penghuni' => $post['nik_penghuni'],
                'nama_penghuni' => $post['nama_penghuni'],
                'no_telp_penghuni' => $post['no_telp_penghuni'],
                'tempat_lahir_penghuni' => $post['tempat_lahir_penghuni'],
                'tgl_lahir_penghuni' => $post['tgl_lahir_penghuni'],
                'jk_penghuni' => $post['jk_penghuni'],
                'alamat_penghuni' => $post['alamat_penghuni'],
                'id_user' => $id_user
            ];
            $this->penghuni->insert($data2);
            return redirect()->to('/login')->with('success', 'Berhasil Mendaftar, Silahkan Login!');
        }
    }

    // public function resetpwProses()
    // {
    //     $builder = $this->db->table('user');
    //     $post = $this->request->getPost();
    //     $query = $this->db->table('user')->getWhere(['email' => $post['email']]);
    //     $user = $query->getRow();

    //     if ($user) {
    //         if ($post['password'] == $post['password2']) {
    //             $data =
    //                 [
    //                     'password' => password_hash($post['password'], PASSWORD_BCRYPT),
    //                 ];

    //             $builder->where('email', $post['email']);
    //             $builder->update($data);
    //             return redirect()->to(site_url('login'))->with('success', 'Berhasil Mengganti Password !');
    //         } else {
    //             $data2 =
    //                 [
    //                     'email' => $post['email'],
    //                 ];
    //             $tes['asd'] = $data2;
    //             echo view('auth/resetpw', $tes);
    //             return redirect()->with('error', 'Password tidak sama');
    //         }
    //     }
    // }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('login'));
    }
}
