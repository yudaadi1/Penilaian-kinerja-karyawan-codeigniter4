<?php

namespace App\Models;

use CodeIgniter\Model;

class Mjbt extends Model
{
    protected $table = 'jabatan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','jabatan'];

    public function getAllJabatan()
    {
        return $this->findAll();
    }

    public function getJabatanWithUser($userId)
    {
        return $this->select('jabatan.*, user.nama')
                    ->join('user', 'user.id_jabatan = jabatan.id')
                    ->where('jabatan.id', $userId)
                    ->findAll();
    }
}
