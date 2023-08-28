<?php

namespace App\Controllers;
use App\Models\Muser;
use App\Models\Mbukti;
use App\Models\Mkinerja;
use App\Models\Msub;

class Subkinerja extends BaseController
{
    public function index()
    {
        $session = session();
        $id_level = $session->get('id_level');
        $id_jabatan = $session->get('id_jabatan');
        $id_user = session()->get('id');
    
        if (session()->get('logged_in') && $id_level === '2' && $id_jabatan) {
            $userModel = new Muser();
            $pegawai = $userModel->getUsersByJabatan($id_jabatan);
            $sub = new Msub();
            $a = $sub->where('id_user', $id_user)->findAll();
            $data = [
                'title' => 'Data Sub-Kinerja Pegawai',
                'pegawai' => $pegawai,
                'sublist'=>$a
              
            ];

            return view('pegawai/subkinerja', $data);
        } else {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }

   
    public function subkinerja()
    {
        $session = session();
        $id_level = $session->get('id_level');
        $id_jabatan = $session->get('id_jabatan');
        $id_user = session()->get('id');
    
        if (session()->get('logged_in') && $id_level === '2' && $id_jabatan) {
            $userModel = new Muser();
            $pegawai = $userModel->getUsersByJabatan($id_jabatan);
            $kinerjaModel = new Mkinerja();
            $kinerja = $kinerjaModel->where('id_user', $id_user)->findAll();
            $mbukti = new Mbukti();
            $bukti = $mbukti->where('id_user', $id_user)->findAll();
            $data = [
                'title' => 'Tambah Data Sub Program',
                'pegawai' => $pegawai,
                'kinerja' => $kinerja,
                'bukti'=>$bukti,
            ];
    
            return view('pegawai/addsub', $data);
        }
    
        return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
    
    

    public function tambahsub(){
        $sub = new Msub();
        $id_user = session()->get('id');
        $entries = $this->request->getPost('entries');
        $id_bukti = $this->request->getPost('bukti');
        $bulan= date('ymdhis');
        if ($entries) {
            $entryCount = 0;
            foreach ($entries as $entry) {
                $entryCount++; 
                $data = [
                    'id' => microtime(true)+ $entryCount,
                    'id_user' => $id_user,
                    'id_kinerja'=>$entry['id_kinerja'],
                    'no' => $entry['no'],
                    'nm_program' => $entry['nm_program'],
                    'indikator' => $entry['indikator'],
                    'target_thn' => $entry['target_thn'],
                    'target_bln' => $entry['target_bln'],
                    'target_nilai' => $entry['target_nilai'],
                    'realisasi_thn' => $entry['realisasi_thn'],
                    'realisasi_bln' => $entry['realisasi_bln'],
                    'realisasi_nilai' => $entry['realisasi_nilai'],
                    'h_thn' => $entry['h_thn'],
                    'h_bln' => $entry['h_bln'],
                    'h_nilai'=>$entry['h_nilai'],
                    'status'=>'ditinjau',
                    'id_bukti'=>$id_bukti,
                    'bulan'=>$bulan,
                ];
                $sub->insert($data);
               
              
            }
        return redirect()->to('Subkinerja')->with('success', 'Data Berhasil ditambah,Sedang Ditinjau Oleh Admin');
    }
}
}