<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'username'      => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'null'          => FALSE,
                'unique'        => TRUE,
            ],
            'password'      => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'null'          => FALSE,
            ],
            'name'          => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'null'          => FALSE,
            ],
            'email'         => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'null'          => FALSE,
                'unique'        => TRUE,
            ],
            'created_at'    => [
                'type'          => 'DATETIME',
                'null'          => TRUE,
            ],
            'updated_at'    => [
                'type'          => 'DATETIME',
                'null'          => TRUE,
            ],
        ]);
        $this->forge->addPrimaryKey('username', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
