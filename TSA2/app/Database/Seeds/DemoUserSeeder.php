<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DemoUserSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('users')->where('username', 'johndoe')->update([
            'password' => password_hash('password', PASSWORD_DEFAULT),
        ]);
    }
}
