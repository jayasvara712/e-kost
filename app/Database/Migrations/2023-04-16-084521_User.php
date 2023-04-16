<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'username' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250,
                'unique'         => true
            ],
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250,
                'unique'         => true
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ],
            'role' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ]
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('user');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
