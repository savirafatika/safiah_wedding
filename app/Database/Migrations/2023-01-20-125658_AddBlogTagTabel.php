<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBlogTagTabel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_blog_tags' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'blog_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'tag_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 0,
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
        $this->forge->addKey('id_blog_tags', true);
        $this->forge->addForeignKey('blog_id', 'blog', 'id_blog', '', 'CASCADE');
        $this->forge->addForeignKey('tag_id', 'tag', 'id_tag', '', 'CASCADE');
        // gives CONSTRAINT `TABLENAME_users_foreign` FOREIGN KEY(`users_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
        $this->forge->createTable('blog_tags');
    }

    public function down()
    {
        $this->forge->dropTable('blog_tags');
    }
}
