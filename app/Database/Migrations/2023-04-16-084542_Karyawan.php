<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Karyawan extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id_karyawan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'nama_karyawan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ],
            'nik_karyawan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250,
                'unique'     => true
            ],
            'jk_karyawan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ],
            'no_telp_karyawan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 13,
                'unique'     => true
            ],
            'alamat_karyawan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ],
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 11
            ]
        ]);
        $this->forge->addKey('id_karyawan', true);
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('karyawan');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('karyawan');
    }
}
