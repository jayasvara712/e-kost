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

    public function getByAll($bulan)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('penyewaan', 'penyewaan.id_penyewaan = penyewaan_detail.id_penyewaan', 'LEFT');
        $builder->join('penghuni', 'penghuni.id_penghuni = penyewaan.id_penghuni', 'LEFT');
        $builder->join('kamar', 'kamar.id_kamar = penyewaan.id_kamar', 'LEFT');
        $builder->where("DATE_FORMAT(transaction_time,'%Y-%m')", $bulan);
        $builder->orderBy('kamar.nomor_kamar', 'ASC');
        return $builder->get()->getResult();
    }

    public function getOrder($id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('order_id, id_penyewaan_detail');
        $builder->limit(1);
        $builder->where('id_penyewaan', $id);
        $builder->orderBy('id_penyewaan_detail', 'DESC');
        return $builder->get()->getFirstRow();
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

    public function sensor_bank($va_number)
    {
        $va_number = $va_number;
        $jmlSensor = 10;
        $afterVal = 0;
        $x = '';

        // untuk mengambil 4 digit angka di tengah nomor hp yang akan disensor
        $sensor = substr($va_number, $afterVal, $jmlSensor);

        //untuk memecah bagian / kelompok angka pertama dan terakhir
        $va_number2 = explode($sensor, $va_number);

        for ($i = 1; $i <= $jmlSensor; $i++) {
            $x .= 'X';
        }

        // untuk menggabungkan angka pertama dan terakhir dengan angka tengah yang sudah di sensor
        $newVa = $va_number2[0] . $x . $va_number2[1];

        // menampilkan hasil data yang disensor
        return $newVa;
    }
}
