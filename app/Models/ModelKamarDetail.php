<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKamarDetail extends Model
{
    // protected $DBGroup              = 'default';
    protected $table                = 'kamar_detail';
    protected $primaryKey           = 'id_kamar_detail';
    protected $returnType           = 'object';
    protected $allowedFields        = [
        'id_kamar', 'id_fasilitas'
    ];
}
