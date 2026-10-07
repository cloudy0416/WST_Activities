<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAuthAndSoftDelete extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'password' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => '', 'null' => false],
        ]);
        $this->forge->addColumn('tasks', [
            'is_archived' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0, 'null' => false],
        ]);
        $this->db->table('users')->where('username', 'johndoe')->update([
            'password' => password_hash('password', PASSWORD_DEFAULT),
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tasks', 'is_archived');
        $this->forge->dropColumn('users', 'password');
    }
}
