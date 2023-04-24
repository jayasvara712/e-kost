<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenyewaanDetail extends Model
{
    // protected $DBGroup              = 'default';
    protected $table                = 'penyewaan_detail';
    protected $primaryKey           = 'id_penyewaan_detail';
    protected $returnType           = 'object';
    protected $allowedFields        = [
        'id_penyewaan', 'no_invoice', 'payment', 'order_id', 'payment_method', 'payment_type', 'transaction_time', 'transaction_status', 'va_number', 'bank'
    ];

    public function getAllDetail($id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('penyewaan', 'penyewaan.id_penyewaan = penyewaan_detail.id_penyewaan', 'LEFT');
        $builder->join('penghuni', 'penghuni.id_penghuni = penyewaan.id_penghuni', 'LEFT');
        $builder->join('kamar', 'kamar.id_kamar = penyewaan.id_kamar', 'LEFT');
        $builder->where('penyewaan_detail.id_penyewaan_detail', $id);
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
        $builder->select('max(' . $this->table . '.no_invoice) as noInvoice');
        $builder->join('penyewaan', 'penyewaan.id_penyewaan=' . $this->table . '.id_penyewaan', 'LEFT');
        $builder->where('penyewaan.tgl_penyewaan', $tanggal);
        $query = $builder->get();
        return $query;
    }

    public function periode($id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('count(id_penyewaan_detail) as x');
        $builder->where('transaction_status', 'settlement');
        $builder->where('id_penyewaan', $id);
        return $builder->get();
    }

    public function cek_status($id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('count(id_penyewaan_detail) as x');
        $builder->where('id_penyewaan', $id);
        $builder->where('transaction_status', 'settlement');
        $builder->orWhere('id_penyewaan', $id);
        $builder->where('transaction_status', 'pending');
        return $builder->get();
    }
}
