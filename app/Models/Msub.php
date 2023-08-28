<?php

namespace App\Models;

use CodeIgniter\Model;

class Msub extends Model
{
    protected $table = 'sub_kinerja';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id','id_user','no','nm_program',
        'id_kinerja','indikator',
        'target_thn','target_bln','target_nilai',
        'realisasi_thn','realisasi_bln','realisasi_nilai',
        'h_thn','h_bln','h_nilai','id_bukti','status','bulan'
];

public function tampilsub($id_sub)
    {
        return $this->select('sub_kinerja.*, kinerja.id,kinerja.id_bukti')
                    ->join('kinerja', 'sub_kinerja.id_kinerja = kinerja.id')
                    ->where('sub_kinerja.id', $id_sub)
                    ->findAll();
    }

    public function getSubKinerjaByKinerjaId($kinerjaId)
    {
        return $this->where('id_kinerja', $kinerjaId)->findAll();
    }
}
