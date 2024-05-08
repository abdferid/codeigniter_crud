<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TasksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'deadline' => [
                'type' => 'DATE', // Use DATETIME type for date and time
                'null' => true,
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME', // Use DATETIME type for date and time
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME', // Use DATETIME type for date and time
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tasks_table');
    }

    public function down()
    {
        //
    }
}
