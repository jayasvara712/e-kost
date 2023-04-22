<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use PHPUnit\Framework\Constraint\Constraint;

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
            'id_invoice' => [
                'type'           => 'char',
                'constraint'     => 20
            ],
            'tgl_penyewaan' => [
                'type'           => 'DATE'
            ],
            'id_penghuni' => [
                'type'           => 'int',
                'constraint'     => 11
            ],
            'id_kamar' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'lama_penyewaan' => [
                'type'           => 'INT',
                'constraint'     => 100
            ],
            'total_harga' => [
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
