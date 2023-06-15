<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TipeKamarGambar extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id_tipe_kamar_gambar' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'id_tipe_kamar' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'image' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ],
        ]);
        $this->forge->addKey('id_tipe_kamar_gambar', true);
        $this->forge->addForeignKey('id_tipe_kamar', 'tipe_kamar', 'id_tipe_kamar', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tipe_kamar_gambar');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tipe_kamar_gambar');
    }
}
