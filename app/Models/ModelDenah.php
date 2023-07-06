<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDenah extends Model
{
    // protected $DBGroup              = 'default';
    protected $table                = 'denah';
    protected $primaryKey           = 'id_denah';
    protected $returnType           = 'object';
    protected $allowedFields        = [
        'judul_denah', 'image_denah', 'deskripsi_denah'
    ];
}
