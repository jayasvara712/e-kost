<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table                = 'user';
    protected $primaryKey           = 'id_user';
    // protected $returnType           = 'object';
    protected $allowedFields        = [
        'username', 'email', 'password', 'role'
    ];

    public function count_all()
    {
        $builder = $this->db->table($this->table);
        $query = $builder->countAll();
        return $query;
    }

    public function register($data)
    {
        $builder = $this->db->table($this->table);
        $builder->insert($data);
        $insert_id = $this->db->insertID();

        return  $insert_id;
    }

    public function dataUser($id, $role)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        if ($role != 'admin') {
            $builder->join($role, $role . '.id_user' . ' = user.id_user', 'LEFT');
        }
        $builder->where('user.id_user', $id);
        return $builder->get();
    }
}
