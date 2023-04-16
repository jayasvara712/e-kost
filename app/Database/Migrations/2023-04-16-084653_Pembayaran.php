<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pembayaran extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id_pembayaran' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'id_penyewaan' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'bukti_pembayaran' => [
                'type'           => 'TEXT'
            ],
            'tanggal_pembayaran' => [
                'type'           => 'DATE'
            ],
            'status_pembayaran' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'metode_pembayaran' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ]
        ]);
        $this->forge->addKey('id_pembayaran', true);
        $this->forge->addForeignKey('id_penyewaan', 'penyewaan', 'id_penyewaan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pembayaran');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('pembayaran');
    }
}
