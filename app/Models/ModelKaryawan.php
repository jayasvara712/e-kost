<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKaryawan extends Model
{
    // protected $DBGroup              = 'default';
    protected $table                = 'karyawan';
    protected $primaryKey           = 'id_karyawan';
    protected $returnType           = 'object';
    protected $allowedFields        = [
        'nama_karyawan', 'nik_karyawan', 'jk_karyawan', 'no_telp_karyawan', 'alamat_karyawan', 'id_user'
    ];

    public function count_all()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->countAll();
        return $query;
    }

    public function get_all()
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('user', 'user.id_user = karyawan.id_user', 'LEFT');
        return $builder->get()->getResult();
    }

    public function get_all_where($id_karyawan)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('user', 'user.id_user = karyawan.id_user', 'LEFT');
        $builder->where('id_karyawan', $id_karyawan);
        $query = $builder->get()->getFirstRow();
        return $query;
    }
}
