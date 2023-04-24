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
            'last_payment' => [
                'type'  => 'double'
            ],
            'payment_period' => [
                'type'           => 'INT',
                'constraint'     => 100
            ],
            'payment_method' => [
                'type'       => 'ENUM',
                'constraint' => ['C', 'M']
            ],
            'last_transaction_time' => [
                'type'       => 'datetime'
            ],
            'last_transaction_status' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50
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
