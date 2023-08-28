<?php

namespace App\Controllers;
use App\Models\Muser;
use App\Models\Mbukti;
use App\Models\Mkinerja;

use DateTime;

class Pegawai extends BaseController
{
    public function index()
    {

        $session = session();
        $id_level = $session->get('id_level');
        $id_jabatan = $session->get('id_jabatan');
      
        if (session()->get('logged_in') && $id_level === '2' && $id_jabatan) {
            $userModel = new Muser();
            $pegawai = $userModel->getUsersByJabatan($id_jabatan);

            $data = [
                'title' => 'Dashboard Pegawai',
                'pegawai' => $pegawai,
              
            ];

            return view('pegawai/dashboard', $data);
        } else {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        
    }

public function read(){
    $session = session();
    $id_level = $session->get('id_level');
    $id_jabatan = $session->get('id_jabatan');
  
    if (session()->get('logged_in') && $id_level === '2' && $id_jabatan) {
        $userModel = new Muser();
        $pegawai = $userModel->getUsersByJabatan($id_jabatan);

        $data = [
            'title' => 'Kurja',
            'pegawai' => $pegawai,
          
        ];

        return view('pegawai/kurja', $data);
    } else {
        return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}


public function kurja()
{
    $request = service('request');
    $Mkinerja = new Mkinerja();
    $id_user = session()->get('id');
    $kolom = ['id','bulan','tahun'];

    // Pengaturan Pencarian
    $cari = $request->getPost('search')['value'];
    $totalRecords = $Mkinerja->countAllResults();

    $Mkinerja->where('id_user', $id_user)->where('status !=', 'ditinjau');

    if (!empty($cari)) {
        $Mkinerja->groupStart();
        $Mkinerja->like('bulan', $cari);
        $Mkinerja->orLike('tahun', $cari);
        $Mkinerja->groupEnd();
    }

    // Pengaturan Urutan
    $orderColumnIndex = $request->getPost('order')[0]['column'];
    $orderDirection = $request->getPost('order')[0]['dir'];
    $orderColumnName = $kolom[$orderColumnIndex];
    $Mkinerja->orderBy($orderColumnName, $orderDirection);

    // Pengaturan Limit dan Offset
    $start = $request->getPost('start');
    $length = $request->getPost('length');
    $Mkinerja->limit($length, $start);

    // Eksekusi Query dan Ambil Data
    $hasil = $Mkinerja->findAll();
    $filter = count($hasil);

    $data = [];

    foreach ($hasil as $key => $item) {
        $data[] = [
            'no' => $item['no'],
            'sasaran' => $item['sasaran'],
            'indikator' => $item['indikator'],
            'ktribulan_realisasi' => $item['ktribulan_realisasi'],
            'ktribulan_target' => $item['ktribulan_target'],
            'ktahunan_realisasi' => $item['ktahunan_realisasi'],
            'ktahunan_target' => $item['ktahunan_target'],
            'anggaran_realisasi' => $item['anggaran_realisasi'],
            'anggaran_target' => $item['anggaran_target'],
            'status'=>$item['status'],
            'bulan'=>$item['bulan'],
            'tahun'=>$item['tahun'],
            'persentase_ktahunan' => is_numeric($item['ktahunan_realisasi']) && is_numeric($item['ktahunan_target'])
                ? ($item['ktahunan_realisasi'] / $item['ktahunan_target']) * 100
                : 'N/A',
            'persentase_ktribulan' => is_numeric($item['ktribulan_realisasi']) && is_numeric($item['ktribulan_target'])
                ? ($item['ktribulan_realisasi'] / $item['ktribulan_target']) * 100
                : 'N/A',
            'persentase_anggaran' => is_numeric($item['anggaran_realisasi']) && is_numeric($item['anggaran_target'])
                ? ($item['anggaran_realisasi'] / $item['anggaran_target']) * 100
                : 'N/A',
        ];
    }
    $response = [
        'draw' => intval($request->getPost('draw')),
        'recordsTotal' => $totalRecords,
        'recordsFiltered' => $filter,
        'data' => $data,
    ];
    return $this->response->setJSON($response);
}




    public function addkurja(){
        $data['title'] = 'Kinerja Pegawai'; // Judul halaman dinamis
        return view('pegawai/addkurja', $data);
    }

    public function savekurja(){
        $kinerja = new Mkinerja();
        $id_user = session()->get('id');
        $tahun = date('ymdhis');
        $bukti = new Mbukti();

        $entries = $this->request->getPost('entries');
        $buktiFile = $this->request->getFile('bukti'); 
       
    if ($buktiFile->isValid() && !$buktiFile->hasMoved()) {
        $buktiFile->move(ROOTPATH . 'writable/bukti');
        $buktiFilePath = $buktiFile->getName();
        $buktiData = [
            'id' => microtime(true),
            'id_user' => $id_user,
            'file' => $buktiFilePath,
        ];
        $bukti->insert($buktiData);
        $id_bukti = $buktiData['id'];
        
    }
        if ($entries) {
            $entryCount = 0;
            foreach ($entries as $entry) {
                $entryCount++; 
                $data = [
                    'id' => microtime(true)+ $entryCount,
                    'no' => $entry['no'],
                    'sasaran' => $entry['sasaran'],
                    'indikator' => $entry['indikator'],
                    'status' =>'ditinjau',
                    'id_bukti'=>$id_bukti,
                    'ktribulan_realisasi' => $this->numeric($entry['ktribulan_realisasi']),
                    'anggaran_realisasi' => $this->numeric($entry['anggaran_realisasi']),
                    'ktahunan_target' => $this->numeric($entry['ktahunan_target']),
                    'ktribulan_target' => $this->numeric($entry['ktribulan_target']),
                    'anggaran_target' => $this->numeric($entry['anggaran_target']),
                    'bulan' => $entry['bulan'],
                    'tahun' => $tahun,
                    'id_user' => $id_user,
                ];
                foreach ($data as $field => $value) {
                    if ($value === null) {
                        return redirect()->back()->withInput()->with('error', 'Nilai harus berupa angka atau angka dengan simbol persen (%)');
                    }
                }
              $data['ktahunan_realisasi'] = $data['ktribulan_realisasi'] * 1;

             
                $kinerja->insert($data);
               
              
            }
    return redirect()->to('Kurja')->with('success', 'Data Berhasil ditambah,Sedang Ditinjau Oleh Admin');
}

}
private function numeric($value)
{
    $value = preg_replace('/[^0-9.%]/', '', $value);
    
    if (strpos($value, '%') !== false) {
        $value = rtrim($value, '%');
    }

    return is_numeric($value) ? $value : null;
}
  
    
}