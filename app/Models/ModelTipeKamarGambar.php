<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTipeKamarGambar extends Model
{
    // protected $DBGroup              = 'default';
    protected $table                = 'tipe_kamar_gambar';
    protected $primaryKey           = 'id_tipe_kamar_gambar';
    protected $returnType           = 'object';
    protected $allowedFields        = [
        'id_tipe_kamar_gambar', 'id_tipe_kamar', 'judul', 'image'
    ];
}
