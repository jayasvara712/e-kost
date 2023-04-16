<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penyewaan extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id_penyewaan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'id_penghuni' => [
                'type'           => 'int',
                'constraint'     => 11
            ],
            'id_kamar' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'tgl_penyewaan' => [
                'type'           => 'DATE'
            ],
            'lama_penyewaan' => [
                'type'           => 'INT',
                'constraint'     => 100
            ],
            'status_penyewaan' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ]
        ]);
        $this->forge->addKey('id_penyewaan', true);
        $this->forge->addForeignKey('id_penghuni', 'penghuni', 'id_penghuni', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_kamar', 'kamar', 'id_kamar', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penyewaan');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('penyewaan');
    }
}
