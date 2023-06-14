<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TipeKamar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tipe_kamar' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'judul_tipe_kamar' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ],
            'gambar_tipe_kamar' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ],
        ]);
        $this->forge->addKey('id_tipe_kamar', true);
        $this->forge->createTable('tipe_kamar');
    }

    public function down()
    {
        $this->forge->dropTable('tipe_kamar');
    }
}
