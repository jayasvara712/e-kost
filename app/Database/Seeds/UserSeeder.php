<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'email' => 'rikoriyana12@gmail.com',
            'password' => password_hash('riko12345', PASSWORD_BCRYPT),
            'role' => 'admin',
        ];
        $this->db->table('user')->insert($data);
    }
}
