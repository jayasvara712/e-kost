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

    public function simpan($data)
    {
        $builder = $this->db->table($this->table);
        $builder->insert($data);
        $insert_id = $this->db->insertID();

        return  $insert_id;
    }
}
