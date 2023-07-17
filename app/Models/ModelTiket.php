<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTiket extends Model
{
    // protected $DBGroup              = 'default';
    protected $table                = 'tiket';
    protected $primaryKey           = 'id_tiket';
    protected $returnType           = 'object';
    protected $allowedFields        = [
        'id_tiket', 'id_penghuni', 'id_karyawan', 'judul_tiket', 'tgl_tiket', 'status_tiket'
    ];

    public function getAll($id_penghuni)
    {
        $builder = $this->db->table($this->table);
        $builder->where('tiket.id_penghuni', $id_penghuni);
        $data = $builder->get()->getResult();

        return $data;
    }

    public function getAllGroup($role)
    {
        $builder = $this->db->table($this->table);
        if($role =='karyawan'){
            $builder->where('tiket.id_penghuni', null);
        }else if($role=='penyewa'){
            $builder->where('tiket.id_penghuni !=', null);
        }
        $data = $builder->get()->getResult();

        return $data;
    }

    public function getAllGroupSpecify($role,$id)
    {
        $builder = $this->db->table($this->table);
        if($role =='karyawan'){
            $builder->where('tiket.id_penghuni', 0);
            $builder->where('tiket.id_karyawan', $id);
        }else if($role=='penyewa'){
            $builder->where('tiket.id_penghuni !=', 0);
        }
        $data = $builder->get()->getResult();

        return $data;
    }

    public function simpan($data)
    {
        $builder = $this->db->table($this->table);
        $builder->insert($data);
        $insert_id = $this->db->insertID();

        return  $insert_id;
    }
}
