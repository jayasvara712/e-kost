<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PenyewaanDetail extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id_penyewaan_detail' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'id_penyewaan' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'no_invoice' => [
                'type'           => 'char',
                'constraint'     => 20
            ],
            'payment' => [
                'type'  => 'double'
            ],
            'order_id' => [
                'type' => 'char',
                'constraint' => 20
            ],
            'payment_type' => [
                'type' => 'varchar',
                'constraint' => 50
            ],
            'payment_method' => [
                'type'       => 'ENUM',
                'constraint' => ['C', 'M']
            ],
            'transaction_time' => [
                'type'       => 'datetime'
            ],
            'transaction_status' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50
            ],
            'va_number' => [
                'type'           => 'char',
                'constraint'     => 50
            ],
            'bank' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50
            ],

        ]);
        $this->forge->addKey('id_penyewaan_detail', true);
        $this->forge->addForeignKey('id_penyewaan', 'penyewaan', 'id_penyewaan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penyewaan_detail');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('penyewaan_detail');
    }
}
