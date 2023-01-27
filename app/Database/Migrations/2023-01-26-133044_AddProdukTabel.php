<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProdukTabel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'deskripsi' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'harga' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'foto_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kategori_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 0,
                'null'       => true,
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
        $this->forge->addKey('id_produk', true);
        $this->forge->addForeignKey('kategori_id', 'kategori', 'id_kategori', 'CASCADE', 'SET NULL');
        $this->forge->createTable('produk');
    }

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}
