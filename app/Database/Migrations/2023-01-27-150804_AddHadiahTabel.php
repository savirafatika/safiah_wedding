<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddHadiahTabel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_hadiah' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_hadiah' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jenis_hadiah' => [
                'type'           => 'ENUM',
                'constraint'     => ['diskon_persen', 'diskon_rupiah', 'khusus'],
                'default'        => 'khusus',
            ],
            'nilai_hadiah' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'default'        => 'belum ada nilai / deskripsi hadiah',
            ],
            'status'      => [
                'type'           => 'ENUM',
                'constraint'     => ['on', 'off'],
                'default'        => 'off',
            ],
            'jml_hari_berlaku'      => [
                'type'           => 'INT',
                'constraint'     => 3,
                'default'        => 1,
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
        $this->forge->addKey('id_hadiah', true);
        $this->forge->createTable('hadiah');
    }

    public function down()
    {
        $this->forge->dropTable('hadiah');
    }
}
