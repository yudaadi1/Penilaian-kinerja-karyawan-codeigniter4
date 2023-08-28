<?php

namespace App\Models;

use CodeIgniter\Model;

class Muser extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','nama', 'nip', 'password','photo','alamat','photo','id_level','id_jabatan'];

    public function getUsersByJabatan($jabatan)
    {
        return $this->where('id_jabatan', $jabatan)->findAll();
    }

    public function getUserById($id_user)
    {
        return $this->find('id',$id_user);
    } 
    

}
