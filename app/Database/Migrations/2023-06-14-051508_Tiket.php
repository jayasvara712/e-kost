<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tiket extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id_tiket' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'id_penghuni' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'id_karyawan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'           => true,
            ],
            'judul_tiket' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ],
            'tgl_tiket' => [
                'type'           => 'DATE'
            ],
            'status_tiket' => [
                'type'           => 'VARCHAR',
                'constraint'     => 250
            ],

        ]);
        $this->forge->addKey('id_tiket', true);
        $this->forge->addForeignKey('id_penghuni', 'penghuni', 'id_penghuni', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_karyawan', 'karyawan', 'id_karyawan', 'CASCADE');
        $this->forge->createTable('tiket');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tiket');
    }
}
