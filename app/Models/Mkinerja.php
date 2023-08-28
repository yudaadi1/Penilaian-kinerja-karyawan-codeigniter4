<?php

namespace App\Models;

use CodeIgniter\Model;

class Mkinerja extends Model
{
    protected $table = 'kinerja';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id',
                                'no',
                                'sasaran',
                                'indikator',
                                'ktribulan_target',
                                'ktahunan_target',
                                'anggaran_target',
                                'ktribulan_realisasi',
                                'ktahunan_realisasi',
                                'anggaran_realisasi',
                                'id_user',
                                'id_bukti',
                                'bulan',
                                'status',
                                'tahun',];


// public function bukti()
// {
//     return $this->belongsTo(Mbukti::class, 'id_bukti'); // Sesuaikan dengan relasi yang sesuai
// }


// public function caribytahun($userId)
// {
//         return $this->select('tahun')->distinct()->where('id_user', $userId)->orderBy('tahun', 'desc')->findAll();
// }
public function filebukti ($id_user)
{
    return $this->select('kinerja.*, bukti.file') // Pilih kolom yang ingin ditampilkan
        ->join('bukti', 'kinerja.id_bukti = bukti.id') // Join tabel Mbukti
        ->where('kinerja.id_user', $id_user)
        ->findAll();
}
}