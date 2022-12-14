<?php

namespace App\Models;

use CodeIgniter\Model;

class FolderModel extends Model
{
    protected $table = 'folder';
    protected $primaryKey = 'id';
    protected $allowedFields = ["id_folder", "folder", "link", "desc", "click"];
    protected $useTimestamps = true;

    public function getFileExcept()
    {
        $builder = $this->table('folder')->where('folder !=', 'Data Perusahaan')->get()->getResultArray();
        return $builder;
    }
    public function updateFolder($id, $folder, $desc)
    {
        $builder = $this->table('folder')->set('folder', $folder)->set('desc', $desc)->where('id_folder', $id)->update();
        return $builder;
    }
}
