<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Denah extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id_denah' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'judul_denah' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250,
            ],
            'image_denah' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250,
            ],
            'deskripsi_denah' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250,
            ],

        ]);
        $this->forge->addKey('id_denah', true);
        $this->forge->createTable('denah');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('denah');
    }
}
