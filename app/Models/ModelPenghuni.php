<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenghuni extends Model
{
    // protected $DBGroup              = 'default';
    protected $table                = 'penghuni';
    protected $primaryKey           = 'id_penghuni';
    protected $returnType           = 'object';
    protected $allowedFields        = [
        'nama_penghuni', 'tgl_lahir_penghuni', 'tempat_lahir_penghuni', 'nik_penghuni', 'jk_penghuni', 'no_telp_penghuni', 'alamat_penghuni', 'id_user'
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
        $builder->join('user', 'user.id_user = penghuni.id_user', 'LEFT');
        return $builder->get()->getResult();
    }

    public function get_all_where($id_penghuni)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('user', 'user.id_user = penghuni.id_user', 'LEFT');
        $builder->where('id_penghuni', $id_penghuni);
        $query = $builder->get()->getFirstRow();
        return $query;
    }
}
