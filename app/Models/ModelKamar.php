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
        'nomor_kamar', 'harga_kamar', 'status_kamar', 'keterangan_kamar', 'id_tipe_kamar', 'lantai_kamar'
    ];

    public function count_all()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->countAll();
        return $query;
    }

    public function getAll()
    {
        $dataTemp = [];

        $kamar = [];
        $fasilitas = [];
        $gambar = [];

        $builder = $this->db->table($this->table);
        $builder->select('kamar.id_kamar,kamar.id_tipe_kamar,kamar.nomor_kamar,kamar.status_kamar,kamar.keterangan_kamar,kamar.harga_kamar, tipe_kamar.judul_tipe_kamar, tipe_kamar_fasilitas.id_fasilitas,tipe_kamar_fasilitas.id_tipe_kamar_fasilitas,fasilitas.judul_fasilitas,tipe_kamar_gambar.image,tipe_kamar_gambar.id_tipe_kamar_gambar');
        $builder->join('tipe_kamar', 'tipe_kamar.id_tipe_kamar =  kamar.id_tipe_kamar', 'LEFT');
        $builder->join('tipe_kamar_fasilitas', 'tipe_kamar_fasilitas.id_tipe_kamar =  tipe_kamar.id_tipe_kamar', 'LEFT');
        $builder->join('tipe_kamar_gambar', 'tipe_kamar_gambar.id_tipe_kamar =  tipe_kamar.id_tipe_kamar', 'LEFT');
        $builder->join('fasilitas', 'fasilitas.id_fasilitas =  tipe_kamar_fasilitas.id_fasilitas', 'LEFT');
        $builder->groupBy('kamar.id_kamar,kamar.id_tipe_kamar,kamar.nomor_kamar,kamar.status_kamar,kamar.keterangan_kamar,kamar.harga_kamar, tipe_kamar.judul_tipe_kamar, tipe_kamar_fasilitas.id_fasilitas,tipe_kamar_fasilitas.id_tipe_kamar_fasilitas,fasilitas.judul_fasilitas,tipe_kamar_gambar.image,tipe_kamar_gambar.id_tipe_kamar_gambar');
        $objKamar = $builder->get()->getResult();

        foreach ($objKamar as $key => $value) {

            array_push(
                $dataTemp,
                [
                    'id_kamar'              => $value->id_kamar,
                    'nomor_kamar'           => $value->nomor_kamar,
                    'harga_kamar'           => $value->harga_kamar,
                    'status_kamar'          => $value->status_kamar,
                    'keterangan_kamar'      => $value->keterangan_kamar,
                    'id_tipe_kamar'         => $value->id_tipe_kamar,
                    'judul_tipe_kamar'      => $value->judul_tipe_kamar,
                    'id_fasilitas'          => $value->id_fasilitas,
                    'judul_fasilitas'       => $value->judul_fasilitas,
                    'id_tipe_kamar_gambar'  => $value->id_tipe_kamar_gambar,
                    'image'                 => $value->image,
                ]
            );

            $temp_kamar =
                [
                    'id_kamar'          => $value->id_kamar,
                    'nomor_kamar'       => $value->nomor_kamar,
                    'harga_kamar'       => $value->harga_kamar,
                    'status_kamar'      => $value->status_kamar,
                    'keterangan_kamar'  => $value->keterangan_kamar,
                    'id_tipe_kamar'     => $value->id_tipe_kamar,
                    'judul_tipe_kamar'  => $value->judul_tipe_kamar,
                ];

            $temp_fasilitas =
                [
                    'id_kamar'          => $value->id_kamar,
                    'id_tipe_kamar'  => $value->id_tipe_kamar,
                    'id_fasilitas'      => $value->id_fasilitas,
                    'judul_fasilitas'   => $value->judul_fasilitas,
                ];

            $temp_gambar =
                [
                    'id_kamar'              => $value->id_kamar,
                    'id_tipe_kamar'  => $value->id_tipe_kamar,
                    'id_tipe_kamar_gambar'  => $value->id_tipe_kamar_gambar,
                    'image'                 => $value->image,
                ];

            if (!in_array($temp_kamar, $kamar)) {
                array_push(
                    $kamar,
                    $temp_kamar
                );
            }
            if (!in_array($temp_fasilitas, $fasilitas)) {
                array_push(
                    $fasilitas,
                    $temp_fasilitas
                );
            }
            if (!in_array($temp_gambar, $gambar)) {
                array_push(
                    $gambar,
                    $temp_gambar
                );
            }
        }

        $dataKamar =
            [
                'kamar'     => $kamar,
                'fasilitas' => $fasilitas,
                'gambar'    => $gambar
            ];

        return $dataKamar;
    }

    public function getAll_Available()
    {
        $dataTemp = [];

        $kamar = [];
        $fasilitas = [];
        $gambar = [];

        $builder = $this->db->table($this->table);
        $builder->select('kamar.id_kamar,kamar.id_tipe_kamar,kamar.nomor_kamar,kamar.status_kamar,kamar.keterangan_kamar,kamar.harga_kamar, tipe_kamar.judul_tipe_kamar, tipe_kamar_fasilitas.id_fasilitas,tipe_kamar_fasilitas.id_tipe_kamar_fasilitas,fasilitas.judul_fasilitas,tipe_kamar_gambar.image,tipe_kamar_gambar.id_tipe_kamar_gambar');
        $builder->join('tipe_kamar', 'tipe_kamar.id_tipe_kamar =  kamar.id_tipe_kamar', 'LEFT');
        $builder->join('tipe_kamar_fasilitas', 'tipe_kamar_fasilitas.id_tipe_kamar =  tipe_kamar.id_tipe_kamar', 'LEFT');
        $builder->join('tipe_kamar_gambar', 'tipe_kamar_gambar.id_tipe_kamar =  tipe_kamar.id_tipe_kamar', 'LEFT');
        $builder->join('fasilitas', 'fasilitas.id_fasilitas =  tipe_kamar_fasilitas.id_fasilitas', 'LEFT');
        $builder->groupBy('kamar.id_kamar,kamar.id_tipe_kamar,kamar.nomor_kamar,kamar.status_kamar,kamar.keterangan_kamar,kamar.harga_kamar, tipe_kamar.judul_tipe_kamar, tipe_kamar_fasilitas.id_fasilitas,tipe_kamar_fasilitas.id_tipe_kamar_fasilitas,fasilitas.judul_fasilitas,tipe_kamar_gambar.image,tipe_kamar_gambar.id_tipe_kamar_gambar');
        $builder->orderBy('status_kamar', 'ASC');
        $objKamar = $builder->get()->getResult();

        foreach ($objKamar as $key => $value) {

            array_push(
                $dataTemp,
                [
                    'id_kamar'              => $value->id_kamar,
                    'nomor_kamar'           => $value->nomor_kamar,
                    'harga_kamar'           => $value->harga_kamar,
                    'status_kamar'          => $value->status_kamar,
                    'keterangan_kamar'      => $value->keterangan_kamar,
                    'id_tipe_kamar'         => $value->id_tipe_kamar,
                    'judul_tipe_kamar'      => $value->judul_tipe_kamar,
                    'id_fasilitas'          => $value->id_fasilitas,
                    'judul_fasilitas'       => $value->judul_fasilitas,
                    'id_tipe_kamar_gambar'  => $value->id_tipe_kamar_gambar,
                    'image'                 => $value->image,
                ]
            );

            $temp_kamar =
                [
                    'id_kamar'          => $value->id_kamar,
                    'nomor_kamar'       => $value->nomor_kamar,
                    'harga_kamar'       => $value->harga_kamar,
                    'status_kamar'      => $value->status_kamar,
                    'keterangan_kamar'  => $value->keterangan_kamar,
                    'id_tipe_kamar'     => $value->id_tipe_kamar,
                    'judul_tipe_kamar'  => $value->judul_tipe_kamar,
                ];

            $temp_fasilitas =
                [
                    'id_kamar'          => $value->id_kamar,
                    'id_tipe_kamar'  => $value->id_tipe_kamar,
                    'id_fasilitas'      => $value->id_fasilitas,
                    'judul_fasilitas'   => $value->judul_fasilitas,
                ];

            $temp_gambar =
                [
                    'id_kamar'              => $value->id_kamar,
                    'id_tipe_kamar'  => $value->id_tipe_kamar,
                    'id_tipe_kamar_gambar'  => $value->id_tipe_kamar_gambar,
                    'image'                 => $value->image,
                ];

            if (!in_array($temp_kamar, $kamar)) {
                array_push(
                    $kamar,
                    $temp_kamar
                );
            }
            if (!in_array($temp_fasilitas, $fasilitas)) {
                array_push(
                    $fasilitas,
                    $temp_fasilitas
                );
            }
            if (!in_array($temp_gambar, $gambar)) {
                array_push(
                    $gambar,
                    $temp_gambar
                );
            }
        }

        $dataKamar =
            [
                'kamar'     => $kamar,
                'fasilitas' => $fasilitas,
                'gambar'    => $gambar
            ];

        return $dataKamar;
    }

    public function getAll_Fasilitas()
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_kamar');
        $id_kamar = $builder->get()->getResult();

        $kamar = [];

        foreach ($id_kamar as $key => $value) {
            $builder = $this->db->table($this->table);
            $builder->join('tipe_kamar', 'tipe_kamar.id_tipe_kamar =  kamar.id_tipe_kamar', 'LEFT');
            $builder->join('tipe_kamar_fasilitas', 'tipe_kamar_fasilitas.id_tipe_kamar =  tipe_kamar.id_tipe_kamar', 'LEFT');
            $builder->join('fasilitas', 'fasilitas.id_fasilitas =  tipe_kamar_fasilitas.id_fasilitas', 'LEFT');
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

    public function getAllAvailable()
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_kamar');
        $builder->orderBy('status_kamar', 'ASC');
        $id_kamar = $builder->get()->getResult();

        $kamar = [];

        foreach ($id_kamar as $key => $value) {
            $builder = $this->db->table($this->table);
            $builder->join('tipe_kamar', 'tipe_kamar.id_tipe_kamar =  kamar.id_tipe_kamar', 'LEFT');
            $builder->join('tipe_kamar_fasilitas', 'tipe_kamar_fasilitas.id_tipe_kamar =  tipe_kamar.id_tipe_kamar', 'LEFT');
            $builder->join('fasilitas', 'fasilitas.id_fasilitas =  tipe_kamar_fasilitas.id_fasilitas', 'LEFT');
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
