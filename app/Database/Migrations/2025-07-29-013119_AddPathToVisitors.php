<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPathToVisitors extends Migration
{
    public function up()
    {
        $this->forge->addColumn('visitors', [
            'path_visited' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'visit_date',
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('visitors', 'path_visited');
    }
}
