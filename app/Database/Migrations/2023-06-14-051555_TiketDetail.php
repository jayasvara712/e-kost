<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TiketDetail extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id_tiket_detail' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'id_tiket' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'user' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'tgl_pesan' => [
                'type'           => 'DATE'
            ],
            'pesan' => [
                'type'           => 'TEXT'
            ],
            'gambar' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ],

        ]);
        $this->forge->addKey('id_tiket_detail', true);
        $this->forge->addForeignKey('id_tiket', 'tiket', 'id_tiket', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tiket_detail');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tiket_detail');
    }
}
