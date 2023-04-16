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
}
