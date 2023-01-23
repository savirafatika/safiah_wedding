<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnSlugTableTag extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tag', [
            'slug' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'unique'         => true,
                'after'          => 'nama_tag',
                'null'           => true
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tag', 'slug');
    }
}
