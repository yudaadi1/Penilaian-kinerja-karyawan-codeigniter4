<?php

namespace App\Models;

use CodeIgniter\Model;

class Mbukti extends Model
{
    protected $table = 'bukti';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','id_user','file'];
}
