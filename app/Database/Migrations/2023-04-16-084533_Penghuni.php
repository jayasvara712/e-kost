<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penghuni extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id_penghuni' => [
                'type'           => 'int',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'nama_penghuni' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ],
            'tgl_lahir_penghuni' => [
                'type'           => 'DATE',
            ],
            'tempat_lahir_penghuni' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ],
            'nik_penghuni' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250,
                'unique'         => true
            ],
            'jk_penghuni' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ],
            'no_telp_penghuni' => [
                'type'           => 'VARCHAR',
                'constraint'     => 13,
                'unique'         => true
            ],
            'alamat_penghuni' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ],
            'foto_ktp' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ],
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 11
            ]
        ]);
        $this->forge->addKey('id_penghuni', true);
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penghuni');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('penghuni');
    }
}
