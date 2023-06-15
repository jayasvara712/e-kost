<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTiketDetail extends Model
{
    // protected $DBGroup              = 'default';
    protected $table                = 'tiket_detail';
    protected $primaryKey           = 'id_tiket_detail';
    protected $returnType           = 'object';
    protected $allowedFields        = [
        'id_tiket_detail', 'id_tiket', 'tgl_pesan', 'pesan', 'gambar', 'user'
    ];

    public function getAll($id_tiket)
    {
        $builder = $this->db->table($this->table);
        $builder->join('tiket', 'tiket.id_tiket =  tiket_detail.id_tiket', 'LEFT');
        $builder->join('karyawan', 'tiket.id_karyawan =  karyawan.id_karyawan', 'LEFT');
        $builder->join('penghuni', 'tiket.id_penghuni =  penghuni.id_penghuni', 'LEFT');
        $builder->where('tiket.id_tiket', $id_tiket);
        $data = $builder->get()->getResult();

        return $data;
    }
}
