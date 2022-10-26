<?php

namespace App\Models;

use CodeIgniter\Model;

class FolderModel extends Model
{
    protected $table = 'folder';
    protected $primaryKey = 'id';
    protected $allowedFields = ["id_folder", "folder", "link", "desc", "click"];
    protected $useTimestamps = true;
}
