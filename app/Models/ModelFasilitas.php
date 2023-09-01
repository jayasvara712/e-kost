<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelFasilitas extends Model
{
    // protected $DBGroup              = 'default';
    protected $table                = 'fasilitas';
    protected $primaryKey           = 'id_fasilitas';
    protected $returnType           = 'object';
    protected $allowedFields        = [
        'judul_fasilitas', 'icon_fasilitas'
    ];

    public function count_all()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->countAll();
        return $query;
    }
}
