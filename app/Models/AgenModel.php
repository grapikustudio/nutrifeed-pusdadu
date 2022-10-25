<?php

namespace App\Models;

use CodeIgniter\Model;

class AgenModel extends Model
{
    protected $table = 'agen';
    protected $primaryKey = 'id';
    protected $allowedFields = ["id_user", "nama_agen", "nama_pemilik", "alamat", "referer"];
    protected $useTimestamps = true;

    public function insertData($email, $namaAgen, $salt, $namaOwner, $alamat, $password, $referer)
    {
        $builderUser = $this->db->table('user')->insert([
            'email' => $email,
            'pass' => $password,
            'name' => $namaAgen,
            'salt' => $salt,
            'status' => 1,
            'role' => 4,
            'updated_at' => $this->setDate(),
            'created_at' => $this->setDate()
        ]);
        $lastId = $this->db->insertID();
        $builderAgen = $this->db->table('agen')->insert([
            'id_user' => $lastId,
            'nama_agen' => $namaAgen,
            'nama_pemilik' => $namaOwner,
            'alamat' => $alamat,
            'referer' => $referer,
            'updated_at' => $this->setDate(),
            'created_at' => $this->setDate()
        ]);
    }
    public function getData()
    {
        $builder = $this->table("agen");
        $builder->select('*, agen.id as id');
        $builder->join('user', 'agen.id_user = user.id');
        $data = $builder->get()->getResultArray();
        return $data;
    }
    public function getQuery($id)
    {
        $builder = $this->table("agen")
            ->select('*,agen.id as id')
            ->join('user', 'agen.id_user = user.id')
            ->where('agen.id', $id)
            ->get()->getResultArray();
        return $builder;
    }
}
