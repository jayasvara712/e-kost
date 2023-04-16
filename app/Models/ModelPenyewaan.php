<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenyewaan extends Model
{
    // protected $DBGroup              = 'default';
    protected $table                = 'penyewaan';
    protected $primaryKey           = 'id_penyewaan';
    protected $returnType           = 'object';
    protected $allowedFields        = [
        'id_penghuni', 'id_kamar', 'tgl_penyewaan', 'lama_penyewaan', 'status_penyewaan'
    ];

    public function get_all()
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('penghuni', 'penghuni.id_penghuni = penyewaan.id_penghuni', 'LEFT');
        $builder->join('kamar', 'kamar.id_kamar = penyewaan.id_kamar', 'LEFT');
        return $builder->get()->getResult();
    }

    public function count_all()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->countAll();
        return $query;
    }
}
