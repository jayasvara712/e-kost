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
        'nomor_kamar', 'harga_kamar', 'status_kamar', 'keterangan_kamar'
    ];

    public function count_all()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->countAll();
        return $query;
    }

    public function getAll()
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_kamar');
        $id_kamar = $builder->get()->getResult();

        $kamar = [];

        foreach ($id_kamar as $key => $value) {
            $builder = $this->db->table($this->table);
            $builder->join('kamar_detail', 'kamar_detail.id_kamar =  kamar.id_kamar', 'LEFT');
            $builder->join('fasilitas', 'fasilitas.id_fasilitas =  kamar_detail.id_fasilitas', 'LEFT');
            $builder->where('kamar.id_kamar', $value->id_kamar);
            $data = $builder->get()->getResult();
            $fasilitas = '';
            foreach ($data as $key => $value) {
                if ($key > 0) {
                    $fasilitas .= ', ' . $value->judul_fasilitas;
                } else {
                    $fasilitas .= $value->judul_fasilitas;
                }
            }

            array_push(
                $kamar,
                [
                    'id_kamar' => $data[0]->id_kamar,
                    'nomor_kamar' => $data[0]->nomor_kamar,
                    'harga_kamar' => $data[0]->harga_kamar,
                    'fasilitas_kamar' => $fasilitas,
                    'status_kamar' => $data[0]->status_kamar,
                    'keterangan_kamar' => $data[0]->keterangan_kamar,
                ]
            );
        }

        return $kamar;
    }

    public function getDetail($id_kamar)
    {
        $kamar = [];

        $builder = $this->db->table($this->table);
        $builder->join('kamar_detail', 'kamar_detail.id_kamar =  kamar.id_kamar', 'LEFT');
        $builder->join('fasilitas', 'fasilitas.id_fasilitas =  kamar_detail.id_fasilitas', 'LEFT');
        $builder->where('kamar.id_kamar', $id_kamar);
        $data = $builder->get()->getResult();
        $fasilitas = '';
        foreach ($data as $key => $value) {
            if ($key > 0) {
                $fasilitas .= ', ' . $value->judul_fasilitas;
            } else {
                $fasilitas .= $value->judul_fasilitas;
            }
        }

        array_push(
            $kamar,
            [
                'id_kamar' => $data[0]->id_kamar,
                'nomor_kamar' => $data[0]->nomor_kamar,
                'harga_kamar' => $data[0]->harga_kamar,
                'fasilitas_kamar' => $fasilitas,
                'status_kamar' => $data[0]->status_kamar,
                'keterangan_kamar' => $data[0]->keterangan_kamar,
            ]
        );

        return $kamar;
    }

    public function simpan($data)
    {
        $builder = $this->db->table($this->table);
        $builder->insert($data);
        $insert_id = $this->db->insertID();

        return  $insert_id;
    }

    public function noKamar()
    {
        $builder = $this->db->table($this->table);
        $builder->select('max(nomor_kamar) as no_kamar');
        $query = $builder->get();
        return $query;
    }

    public function detailKamar($id_kamar)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        // $builder->join('fasilitas', 'fasilitas.id_fasilitas = kamar.id_fasilitas', 'LEFT');
        $builder->where('id_kamar', $id_kamar);
        $hasil = $builder->get()->getFirstRow();

        return $hasil;
    }

    public function cekKamar($id_kamar)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        // $builder->join('fasilitas', 'fasilitas.id_fasilitas = kamar.id_fasilitas', 'LEFT');
        $builder->where('id_kamar', $id_kamar);
        $builder->where('status_kamar', 'Tersedia');
        $hasil = $builder->get();
    }

    public function getKamar()
    {
        $kamar = $this->db->table($this->table)->get()->getResult();
        $id_fasilitas[] = explode(',', $kamar->id_fasilitas);
        $builder = $this->db->table('fasilitas');
        $builder->where('id_fasilitas', $kamar->id_fasilitas);
        $hasil = $builder->get()->getResult();

        return $hasil;
    }
}
