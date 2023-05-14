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
            return redirect()->to(site_url('/' . session('role')));
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
                        'isLoggedIn'    => true,
                        'pembayaran'    => 'none'
                    ];
                    session()->set($params);
                    return redirect()->to(site_url('/admin'))->with('success', 'Selamat Datang, anda login sebagai Admin');
                } else if ($user->role == 'penghuni') {
                    $query = $this->penghuni->getWhere(['id_user' => $user->id_user]);
                    $penghuni = $query->getRow();
                    $params = [
                        'id_user'       => $user->id_user,
                        'id_penghuni'   => $penghuni->id_penghuni,
                        'username'      => $user->username,
                        'name'          => $penghuni->nama_penghuni,
                        'role'          => $user->role,
                        'isLoggedIn'    => true,
                        'pembayaran'    => 'none'
                    ];
                    session()->set($params);
                    return redirect()->to(site_url('/penghuni'))->with('success', 'Selamat Datang, anda berhasil login sebagai ' . $penghuni->nama_penghuni);
                } else if ($user->role == 'karyawan') {
                    $query = $this->karyawan->getWhere(['id_user' => $user->id_user]);
                    $karyawan = $query->getRow();
                    $params = [
                        'id_user'       => $user->id_user,
                        'username'      => $user->username,
                        'name'          => $karyawan->nama_karyawan,
                        'role'          => $user->role,
                        'isLoggedIn'    => true,
                        'pembayaran'    => 'none'
                    ];
                    session()->set($params);
                    return redirect()->to(site_url('/karyawan'))->with('success', 'Selamat Datang, anda berhasil login sebagai ' . $karyawan->nama_karyawan);
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
                'rules'  => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Nomor Telepon Penghuni Tidak Boleh Kosong!',
                    'min_length' => 'Nomor Telepon Minimal 10 Angka!'
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
            return redirect()->to('/login')->with('success', 'Berhasil Mendaftar Silahkan Login!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('login'));
    }

    public function setting()
    {
        $role = session()->role;
        $id = session()->id_user;
        $user = $this->user->dataUser($id, $role)->getFirstRow();
        $data = [
            'user' => $user,
            'no_telp'   => 'no_telp_' . $role,
            'alamat'   => 'alamat_' . $role,
            'validation' => \Config\Services::validation()
        ];
        if (is_object($user)) {
            $data['user'] = $user;
            echo view('auth/setting', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($id)
    {
        $post = $this->request->getPost();
        if (session()->role == 'admin') {
            $validation = $this->validate([
                'email' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Email Tidak Boleh Kosong!'
                    ]
                ],
                'password_lama' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Password Tidak Boleh Kosong!',

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
            ]);
        } else {
            $validation = $this->validate([
                'email' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Email Tidak Boleh Kosong!'
                    ]
                ],
                'password_lama' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Password Tidak Boleh Kosong!',

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
                'no_telp' => [
                    'rules'  => 'required|min_length[10]',
                    'errors' => [
                        'required' => 'Nomor Telepon Penghuni Tidak Boleh Kosong!',
                        'min_length' => 'Nomor Telepon Minimal 10 Angka!'
                    ]
                ],
                'alamat' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Alamat Penghuni Tidak Boleh Kosong!'
                    ]
                ],
            ]);
        }

        if (!$validation) {
            $validation = \config\Services::validation();
            return redirect()->to(session()->role . '/setting')->withInput()->with('validation', $validation);
        } else {

            $id_user = session()->id_user;
            $role = session()->role;
            $id = 'id_' . $role;

            $user = $this->user->dataUser($id_user, $role)->getFirstRow();

            if (password_verify($post['password_lama'], $user->password)) {
                $data1 = [
                    'password' => password_hash($post['password'], PASSWORD_BCRYPT),
                ];
                $this->user->update($id_user, $data1);

                if ($role != 'admin') {
                    $data2 = [
                        'no_telp_' . $role => $post['no_telp'],
                        'alamat_' . $role => $post['alamat'],
                    ];
                    $this->$role->update($user->$id, $data2);
                }
                return redirect()->to(site_url($role))->with('success', 'Data User Berhasil Dirubah');
            } else {
                return redirect()->to(session()->role . '/setting')->withInput()->with('error', 'Password lama salah');
            }
        }
    }

    public function resetPass()
    {
        $data = [
            'title' => 'Register E-Kost',
            'validation' => \config\Services::validation()
        ];
        return view('auth/reqEmail', $data);
    }

    public function sendLink()
    {
        $email = \Config\Services::email();
        $post = $this->request->getPost();
        $user = $this->user->getWhere(['email' => $post['email']])->getFirstRow();
        if ($user) {

            $msg = "
                Hi There,
                <br>
                You have requested your EKost password account to be reset. Please click the following link to change your password:
                <br>
                <a href='http://172.28.24.24:8081/reset/" . $user->id_user . "' style='background-color: #4CAF50; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none;display: inline-block; font-size: 16px;'>Change my password</a>
                <br>
                If you did not request this, please ignore this email and report to us via this link
                <br>
                Report to us.
                
                thanks,
                Ekost
            ";
            //email send
            $email->setFrom('noreply-ekost@littlejay.my.id', 'Ekost');
            $email->setTo($post['email']);
            $email->setSubject('Reset Password');
            $email->setMessage($msg);
            $status = $email->send();
            if ($status) {
                return redirect()->to(site_url('/login'))->with('success', 'Email reset password berhasil dikirim, silahkan cek email anda!');
            } else {
                return false;
            }
        } else {
            redirect()->to(site_url('/forgot_password'))->with('error', 'Email tidak terdaftar !');
        }
    }

    public function resetPw($id = null)
    {
        $user = $this->user->where('id_user', $id)->first();
        if ($user != null) {
            $data = [
                'id'        => $id,
                'title' => 'Register E-Kost',
                'validation' => \config\Services::validation()
            ];
            return view('auth/resetPw', $data);
        } else {
            return redirect()->to(site_url('/login'))->with('error', 'Maaf anda tidak punya akses ke halaman ini!');
        }
    }

    public function resetProcess()
    {
        $post = $this->request->getPost();
        $validation = $this->validate([
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
        ]);

        if (!$validation) {
            $validation = \config\Services::validation();
            return redirect()->to('/reset/' . $post['id_user'])->withInput()->with('validation', $validation);
        } else {

            $data = [
                'password' => password_hash($post['password'], PASSWORD_BCRYPT),
            ];
            $update = $this->user->update($post['id_user'], $data);
            if ($update) {
                return redirect()->to(site_url('/login'))->with('success', 'Password berhasil diubah!');
            } else {
                return redirect()->to(site_url('/login'))->with('error', 'Gagal mengubah password!');
            }
        }
    }
}
