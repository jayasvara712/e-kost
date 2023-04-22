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
        'no_invoice', 'tgl_penyewaan', 'id_penghuni', 'id_kamar', 'lama_penyewaan ', 'total_harga', 'order_id', 'payment_method', 'payment_type', 'transaction_time', 'transaction_status', 'va_number', 'bank'
    ];

    public function get_all()
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('penghuni', 'penghuni.id_penghuni = penyewaan.id_penghuni', 'LEFT');
        $builder->join('kamar', 'kamar.id_kamar = penyewaan.id_kamar', 'LEFT');
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

    public function count_all()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->countAll();
        return $query;
    }

    public function noInvoice($tanggal)
    {
        $builder = $this->db->table($this->table);
        $builder->select('max(no_invoice) as noInvoice');
        $builder->where('tgl_penyewaan', $tanggal);
        $query = $builder->get();
        return $query;
    }
}
