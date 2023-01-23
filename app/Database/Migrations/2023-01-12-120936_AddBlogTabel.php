<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBlogTabel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_blog' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'deskripsi_singkat' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'isi' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'thumbnail' => [
                'type'       => 'VARCHAR',
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
        $this->forge->addKey('id_blog', true);
        $this->forge->createTable('blog');
    }

    public function down()
    {
        $this->forge->dropTable('blog');
    }
}
