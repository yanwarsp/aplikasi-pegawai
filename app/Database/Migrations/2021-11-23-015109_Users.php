<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        //buat skema tabel users
        $this->forge->addField([
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'namadepan' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'namabelakang' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
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
        $this->forge->addPrimaryKey('username', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        //buat perintah untuk drop table  
        $this->forge->dropTable('users');
    }
}
