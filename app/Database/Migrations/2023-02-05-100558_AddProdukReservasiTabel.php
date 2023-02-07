<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProdukReservasiTabel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_produk_reservasi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'reservasi_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'produk_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'qty' => [
                'type'       => 'INT',
                'constraint' => 4
            ],
            'subtotal' => [
                'type'       => 'VARCHAR',
                'constraint' => '20'
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
        $this->forge->addKey('id_produk_reservasi', true);
        $this->forge->addForeignKey('reservasi_id', 'reservasi', 'id_reservasi', '', 'CASCADE');
        $this->forge->addForeignKey('produk_id', 'produk', 'id_produk', '', 'CASCADE');
        $this->forge->createTable('produk_reservasi');
    }

    public function down()
    {
        $this->forge->dropTable('produk_reservasi');
    }
}
