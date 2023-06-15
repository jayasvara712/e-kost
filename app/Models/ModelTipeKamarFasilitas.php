<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTipeKamarFasilitas extends Model
{
    // protected $DBGroup              = 'default';
    protected $table                = 'tipe_kamar_fasilitas';
    protected $primaryKey           = 'id_tipe_kamar_fasilitas';
    protected $returnType           = 'object';
    protected $allowedFields        = [
        'id_tipe_kamar_fasilitas', 'id_tipe_kamar', 'id_fasilitas'
    ];
}
