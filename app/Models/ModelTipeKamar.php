<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTipeKamar extends Model
{
    // protected $DBGroup              = 'default';
    protected $table                = 'tipe_kamar';
    protected $primaryKey           = 'id_tipe_kamar';
    protected $returnType           = 'object';
    protected $allowedFields        = [
        'id_tipe_kamar', 'judul_tipe_kamar'
    ];

    public function getAll_TipeKamar()
    {
        $dataTemp = [];

        $tipeKamar = [];
        $fasilitas = [];
        $gambar = [];

        $builder = $this->db->table($this->table);
        $builder->select('tipe_kamar.id_tipe_kamar,tipe_kamar.judul_tipe_kamar, tipe_kamar_fasilitas.id_fasilitas,tipe_kamar_fasilitas.id_tipe_kamar_fasilitas,fasilitas.judul_fasilitas,tipe_kamar_gambar.image,tipe_kamar_gambar.id_tipe_kamar_gambar');
        $builder->join('tipe_kamar_fasilitas', 'tipe_kamar_fasilitas.id_tipe_kamar =  tipe_kamar.id_tipe_kamar', 'LEFT');
        $builder->join('tipe_kamar_gambar', 'tipe_kamar_gambar.id_tipe_kamar =  tipe_kamar.id_tipe_kamar', 'LEFT');
        $builder->join('fasilitas', 'fasilitas.id_fasilitas =  tipe_kamar_fasilitas.id_fasilitas', 'LEFT');
        $builder->groupBy('tipe_kamar.id_tipe_kamar,tipe_kamar.judul_tipe_kamar, tipe_kamar_fasilitas.id_fasilitas,tipe_kamar_fasilitas.id_tipe_kamar_fasilitas,fasilitas.judul_fasilitas,tipe_kamar_gambar.image,tipe_kamar_gambar.id_tipe_kamar_gambar');
        $objKamar = $builder->get()->getResult();

        foreach ($objKamar as $key => $value) {

            array_push(
                $dataTemp,
                [
                    'id_tipe_kamar'         => $value->id_tipe_kamar,
                    'judul_tipe_kamar'      => $value->judul_tipe_kamar,
                    'id_fasilitas'          => $value->id_fasilitas,
                    'judul_fasilitas'       => $value->judul_fasilitas,
                    'id_tipe_kamar_gambar'  => $value->id_tipe_kamar_gambar,
                    'image'                 => $value->image,
                ]
            );

            $temp_tipeKamar =
                [
                    'id_tipe_kamar'  => $value->id_tipe_kamar,
                    'judul_tipe_kamar'      => $value->judul_tipe_kamar,
                ];

            $temp_fasilitas =
                [
                    'id_tipe_kamar'  => $value->id_tipe_kamar,
                    'id_fasilitas'      => $value->id_fasilitas,
                    'judul_fasilitas'   => $value->judul_fasilitas,
                ];

            $temp_gambar =
                [
                    'id_tipe_kamar'  => $value->id_tipe_kamar,
                    'id_tipe_kamar_gambar'  => $value->id_tipe_kamar_gambar,
                    'image'                 => $value->image,
                ];

            if (!in_array($temp_tipeKamar, $tipeKamar)) {
                array_push(
                    $tipeKamar,
                    $temp_tipeKamar
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

        $dataTipeKamar =
            [
                'tipeKamar' => $tipeKamar,
                'fasilitas' => $fasilitas,
                'gambar'    => $gambar
            ];

        return $dataTipeKamar;
    }

    public function getAll()
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_tipe_kamar');
        $id_tipe_kamar = $builder->get()->getResult();

        $tipe_kamar = [];

        foreach ($id_tipe_kamar as $key => $value) {
            $builder = $this->db->table($this->table);
            $builder->join('tipe_kamar_fasilitas', 'tipe_kamar.id_tipe_kamar =  tipe_kamar_fasilitas.id_tipe_kamar', 'LEFT');
            $builder->join('fasilitas', 'fasilitas.id_fasilitas =  tipe_kamar_fasilitas.id_fasilitas', 'LEFT');
            $builder->where('tipe_kamar.id_tipe_kamar', $value->id_tipe_kamar);
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
                $tipe_kamar,
                [
                    'id_tipe_kamar' => $data[0]->id_tipe_kamar,
                    'judul_tipe_kamar' => $data[0]->judul_tipe_kamar,
                    'fasilitas_kamar' => $fasilitas,
                ]
            );
        }

        return $tipe_kamar;
    }


    public function simpan($data)
    {
        $builder = $this->db->table($this->table);
        $builder->insert($data);
        $insert_id = $this->db->insertID();

        return  $insert_id;
    }
}
