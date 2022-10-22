<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = ["email", "pass", "name", "salt", "status", "role"];
    protected $useTimestamps = true;
}
