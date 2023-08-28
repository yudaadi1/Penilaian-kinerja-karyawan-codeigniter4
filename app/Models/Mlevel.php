<?php

namespace App\Models;

use CodeIgniter\Model;

class Mlevel extends Model
{
    protected $table = 'level';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','nama'];
}
