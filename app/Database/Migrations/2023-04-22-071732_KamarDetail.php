<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KamarDetail extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kamar_detail' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'id_kamar' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'id_fasilitas' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
        ]);
        $this->forge->addKey('id_kamar_detail', true);
        $this->forge->createTable('kamar_detail');
    }

    public function down()
    {
        $this->forge->dropTable('kamar_detail');
    }
}
