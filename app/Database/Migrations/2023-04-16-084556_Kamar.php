<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kamar extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id_kamar' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'id_tipe_kamar' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'nomor_kamar' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ],
            'status_kamar' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'lantai_kamar' => [
                'type'           => 'INT',
                'constraint'     => 10
            ],
            'keterangan_kamar' => [
                'type'           => 'TEXT'
            ],
            'harga_kamar' => [
                'type'           => 'INT',
                'constraint'     => 100
            ]
        ]);
        $this->forge->addKey('id_kamar', true);
        $this->forge->addForeignKey('id_tipe_kamar', 'tipe_kamar', 'id_tipe_kamar', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kamar');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('kamar');
    }
}
