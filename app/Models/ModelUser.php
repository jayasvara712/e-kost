<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table                = 'user';
    protected $primaryKey           = 'id_user';
    protected $returnType           = 'object';
    protected $allowedFields        = [
        'username', 'email', 'password', 'role'
    ];

    public function count_all()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->countAll();
        return $query;
    }
}
