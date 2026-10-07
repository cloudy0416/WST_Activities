<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['username', 'full_name', 'email', 'password', 'created_at'];

    // Get the single demo user profile
    public function getDemoUser()
    {
        return $this->select('id, username, full_name, email, created_at')->first();
    }

    public function findByUsername(string $username)
    {
        return $this->where('username', $username)->first();
    }
}
