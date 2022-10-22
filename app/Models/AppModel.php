<?php

namespace App\Models;

use CodeIgniter\Model;

class AppModel extends Model
{
    protected $table = 'link';
    protected $primaryKey = 'id';
    protected $allowedFields = ["link", "category", "click"];
    protected $useTimestamps = true;

    public function getClick()
    {
        $builder = $this->table('link')->selectSum('click')->get()->getResult();
        return $builder;
    }
    public function setClick($url)
    {
        $builder = $this->table('link');
        $builder->set('click', 'click+1', false);
        $builder->where('link', $url);
        $builder->update();
        return $builder;
    }
    public function getFileExcept()
    {
        $builder = $this->table('link')->where('category !=', 'Data Perusahaan')->get()->getResultArray();
        return $builder;
    }
}
