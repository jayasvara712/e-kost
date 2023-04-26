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
        'no_invoice', 'tgl_penyewaan', 'id_penghuni', 'id_kamar', 'lama_penyewaan ', 'last_payment', 'payment_period', 'payment_method', 'last_transaction_time', 'last_transaction_status'
    ];

    public function getAll()
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('penghuni', 'penghuni.id_penghuni = penyewaan.id_penghuni', 'LEFT');
        $builder->join('kamar', 'kamar.id_kamar = penyewaan.id_kamar', 'LEFT');
        return $builder->get()->getResult();
    }

    public function getByAll($bulan, $status)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('penghuni', 'penghuni.id_penghuni = penyewaan.id_penghuni', 'LEFT');
        $builder->join('kamar', 'kamar.id_kamar = penyewaan.id_kamar', 'LEFT');
        if ($status != '') {
            $builder->where('last_transaction_status', $status);
        }
        $builder->where("DATE_FORMAT(tgl_penyewaan,'%Y-%m')", $bulan);
        return $builder->get()->getResult();
    }

    public function getDetail($id_penghuni)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('penghuni', 'penghuni.id_penghuni = penyewaan.id_penghuni', 'LEFT');
        $builder->join('kamar', 'kamar.id_kamar = penyewaan.id_kamar', 'LEFT');
        $builder->where('penghuni.id_penghuni', $id_penghuni);
        return $builder->get()->getResult();
    }

    public function getDetailPenyewaaan($id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('penghuni', 'penghuni.id_penghuni = penyewaan.id_penghuni', 'LEFT');
        $builder->join('kamar', 'kamar.id_kamar = penyewaan.id_kamar', 'LEFT');
        $builder->where('penyewaaan.id_penyewaaan', $id);
        return $builder->get()->getResult();
    }

    public function getAllDetail($id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('penyewaan_detail', 'penyewaan_detail.id_penyewaan = penyewaan.id_penyewaan', 'LEFT');
        $builder->join('penghuni', 'penghuni.id_penghuni = penyewaan.id_penghuni', 'LEFT');
        $builder->join('kamar', 'kamar.id_kamar = penyewaan.id_kamar', 'LEFT');
        $builder->where('penyewaan.id_penyewaan', $id);
        return $builder->get()->getResult();
    }

    public function count_all()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->countAll();
        return $query;
    }

    public function simpan($data)
    {
        $builder = $this->db->table($this->table);
        $builder->insert($data);
        $insert_id = $this->db->insertID();

        return  $insert_id;
    }
}
