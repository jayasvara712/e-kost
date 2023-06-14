<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TipeKamarFasilitas extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id_tipe_kamar_fasilitas' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'id_tipe_kamar' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'id_fasilitas' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
        ]);
        $this->forge->addKey('id_tipe_kamar_fasilitas', true);
        $this->forge->addForeignKey('id_tipe_kamar', 'tipe_kamar', 'id_tipe_kamar', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_fasilitas', 'fasilitas', 'id_fasilitas', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tipe_kamar_fasilitas');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tipe_kamar_fasilitas');
    }
}
