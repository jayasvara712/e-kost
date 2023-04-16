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
            'nomor_kamar' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ],
            'id_fasilitas' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'status_kamar' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
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
        $this->forge->addForeignKey('id_fasilitas', 'fasilitas', 'id_fasilitas', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kamar');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('kamar');
    }
}
