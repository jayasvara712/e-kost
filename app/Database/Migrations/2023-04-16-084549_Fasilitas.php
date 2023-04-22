<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Fasilitas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_fasilitas' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'judul_fasilitas' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250,
                'unique'         => true
            ]
        ]);
        $this->forge->addKey('id_fasilitas', true);
        $this->forge->createTable('fasilitas');
    }

    public function down()
    {
        $this->forge->dropTable('fasilitas');
    }
}
