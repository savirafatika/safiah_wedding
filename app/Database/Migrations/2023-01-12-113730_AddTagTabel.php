<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTagTabel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tag' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_tag' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'deskripsi_tag' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
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
        $this->forge->addKey('id_tag', true);
        $this->forge->createTable('tag');
    }

    public function down()
    {
        $this->forge->dropTable('tag');
    }
}
