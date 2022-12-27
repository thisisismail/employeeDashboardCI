<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Employees extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'position' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'contract' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('employees');
    }

    public function down()
    {
        //
    }
}