<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table = 'file';
    protected $primaryKey = 'id';
    protected $allowedFields = ["id_file", "name", "folder"];
    protected $useTimestamps = true;

    public function deleteFile($id)
    {
        $builder = $this->table('folder');
        $builder->where('id_folder', $id);
        $builder->delete();
        return $builder;
    }
    public function getFileExcept()
    {
        $builder = $this->table('file')->where('folder !=', 'Data Perusahaan')->get()->getResultArray();
        return $builder;
    }
}
