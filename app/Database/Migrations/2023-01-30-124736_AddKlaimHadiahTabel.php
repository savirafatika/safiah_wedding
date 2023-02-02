<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKlaimHadiahTabel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_klaim_hadiah' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'hadiah_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'selesai_berlaku' => [
                'type' => 'DATETIME',
                'null' => TRUE,
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
        $this->forge->addKey('id_klaim_hadiah', true);
        $this->forge->createTable('klaim_hadiah');
    }

    public function down()
    {
        $this->forge->dropTable('klaim_hadiah');
    }
}
