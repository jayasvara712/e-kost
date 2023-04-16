<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKamar extends Model
{
    // protected $DBGroup              = 'default';
    protected $table                = 'kamar';
    protected $primaryKey           = 'id_kamar';
    protected $returnType           = 'object';
    protected $allowedFields        = [
        'nomor_kamar', 'harga_kamar', 'id_fasilitas', 'status_kamar', 'keterangan_kamar'
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
        $builder->join('fasilitas', 'fasilitas.id_fasilitas = kamar.id_fasilitas', 'LEFT');
        $hasil = $builder->get()->getResult();

        return $hasil;
        // memisahkan  fasilitas
    }
}
