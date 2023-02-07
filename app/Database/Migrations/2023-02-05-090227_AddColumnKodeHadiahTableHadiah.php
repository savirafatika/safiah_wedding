<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnKodeHadiahTableHadiah extends Migration
{
    public function up()
    {
        $this->forge->addColumn('hadiah', [
            'kode_hadiah' => [
                'type'           => 'VARCHAR',
                'constraint'     => '6',
                'unique'         => true,
                'after'          => 'jml_hari_berlaku',
                'null'           => true
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('hadiah', 'kode_hadiah');
    }
}
