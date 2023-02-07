<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddReservasiTabel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_reservasi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tgl_acara' => [
                'type'       => 'DATE'
            ],
            'nama_pemesan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'no_wa' => [
                'type'       => 'VARCHAR',
                'constraint' => '13',
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'hadiah_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => TRUE,
            ],
            'member_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => TRUE,
            ],
            'potongan_harga' => [
                'type'       => 'VARCHAR',
                'constraint' => '30'
            ],
            'total_bayar' => [
                'type'       => 'VARCHAR',
                'constraint' => '30'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE,
            ],
        ]);
        $this->forge->addKey('id_reservasi', true);
        $this->forge->addForeignKey('hadiah_id', 'hadiah', 'id_hadiah', '', 'CASCADE');
        $this->forge->addForeignKey('member_id', 'users', 'id', '', 'CASCADE');
        $this->forge->createTable('reservasi');
    }

    public function down()
    {
        $this->forge->dropTable('reservasi');
    }
}
