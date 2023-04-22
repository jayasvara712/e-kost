<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kamar extends Migration
{
    public function up()
    {
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
        $this->forge->createTable('kamar');
    }

    public function down()
    {
        $this->forge->dropTable('kamar');
    }
}
