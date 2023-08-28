<?php

namespace App\Controllers;
use App\Models\Muser;
use App\Models\Mjbt;
use App\Models\Mkinerja;
use App\Models\Msub;
use App\Models\Mbukti;
class Admin extends BaseController
{
    protected $level = [
        1 => 'Admin',
        2 => 'Pegawai',
      
    ];
    
    public function index()
    {
        $data= [
            'title' => 'Dashboard Admin',
            'totaluser' => $this->countTotalPegawai(),
           'totaljabatan'=>$this->totaljabatan(),
           'totallevel'=>$this->totallevel(),
        ];
        if (session()->get('logged_in') && session()->get('id_level') === '1') {
            return view('admin/dashboard',$data);
        } else {
            return redirect()->back(); 
        }
    }

    protected function countTotalPegawai(){
    $db = \Config\Database::connect(); // Menghubungkan ke database
    $builder = $db->table('user');

    // Menghitung jumlah pengguna dengan level selain admin
    $pegawaiCount = $builder->where('id_level !=', 1)->countAllResults();

    return $pegawaiCount;
}

protected function totaljabatan(){
   
    $db = \Config\Database::connect();
    $builder = $db->table('jabatan');
    $totalJabatan = $builder->countAllResults();

    return $totalJabatan;
}

protected function totallevel(){
  
    $db = \Config\Database::connect();
    $builder = $db->table('level');
    $totallevel = $builder->countAllResults();

    return $totallevel;
}

    public function read(){
        if (session()->get('logged_in') && session()->get('id_level') === '1') {
            $user = new Muser();
           
            $data = [
                'title' => 'Data Pegawai Dinas Koperasi',
                
            ];
            $data['list']=$user->findAll();
    
            return view('admin/pegawai',$data);
        }else{
            return redirect()->back();
        }
    }

    public function fetchPegawaiData()
    {
        $request = service('request');
        $user = new Muser();
        $jabatanModel = new Mjbt();

        $kolom = ['id', 'nama', 'nip', 'alamat', 'id_level','id_jabatan'];

        $cari = $request->getPost('search')['value'];
        $jmlkolom = $kolom[$request->getPost('order')[0]['column']];
        $orderDirection = $request->getPost('order')[0]['dir'];
        $start = $request->getPost('start');
        $length = $request->getPost('length');

        $totalRecords = $user->countAllResults();

        
        if (!empty($cari)) {
            $user->groupStart();
            $user->like('nama', $cari);
            $user->orLike('nip', $cari);
            $user->orLike('alamat', $cari);
            $user->groupEnd();
        }

        $user->orderBy($jmlkolom, $orderDirection);
        $user->limit($length, $start);
        $hasil = $user->findAll();

        $filter = count($hasil);

        $data = [];

        foreach ($hasil as $key => $pegawai) {
            $jabatan = $jabatanModel->find($pegawai['id_jabatan']); // Ambil data jabatan berdasarkan id_jabatan
            $jabatanPegawai = $jabatan ? $jabatan['jabatan'] : 'Unknown Jabatan'; // Ambil nama jabatan, jika tidak ada, tampilkan "Unknown Jabatan"
            $data[] = [
                'No' => $key + 1,
                'Nama' => $pegawai['nama'],
                'Username' => $pegawai['nip'],
                'Alamat' => $pegawai['alamat'],
                'Jabatan' => $jabatanPegawai,
                'level' => isset($this->level[$pegawai['id_level']]) ? $this->level[$pegawai['id_level']] : 'Unknown Level',
                'Aksi' => '
                    <form action="' . base_url('editdata') . '" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="' . $pegawai['id'] . '">
                        <button class="btn btn-warning btn-sm" type="submit"><i class="far fa-edit"></i></button>
                    </form>
                    <form action="' . base_url('deletedata/' . $pegawai['id']) . '" method="post" style="display: inline;">
                        <button type="submit" class="btn btn-danger btn-sm" id="hapus"><i class="fas fa-trash-alt"></i></button>
                    </form>
                ',
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

    public function tambahuser()  {
        $mjbt= new Mjbt();
        $data['jabatan_list'] = $mjbt->findAll();
        $data['title'] = 'Tambah Data Pegawai'; // Judul halaman dinamis
        return view('admin/addpegawai', $data);
    }

   
    public function add()
    {
        $currentTime = microtime('YmdHis'); 
        $customId = $currentTime;

        $nama = $this->request->getPost('nama');
        $nip = $this->request->getPost('nip');
        $alamat = $this->request->getPost('alamat');
        $password = $this->request->getPost('password');
        $id_level = $this->request->getPost('id_level');
        $id_jabatan = $this->request->getPost('id_jabatan');
    
        $hashedPassword = md5($password);
    
        $data = [
            'id' => $customId,
            'nama' => $nama,
            'nip' => $nip,
            'alamat' => $alamat,
            'password' => $hashedPassword,
            'id_level' => $id_level,
            'id_jabatan' => $id_jabatan,
        ];
        $jabatanModel = new Mjbt();
        $jabatan = $jabatanModel->find($id_jabatan);
        if (!$jabatan) {
            return redirect()->back()->with('error', 'ID Jabatan yang dimasukkan tidak valid.');
        }

        $userModel = new Muser();
        $userModel->insert($data);
        return redirect()->to('Data-Pegawai')->with('success', 'Data sukses ditambah');
    }


    public function tjbtn (){
        $data['title'] = 'Tambah Jabatan'; // Judul halaman dinamis
        return view('admin/jabatan', $data);
    }

    public function savejbtn(){
        $currentTime = microtime('YmdHis'); // Current time in YYYYmmddHHiiSS format
        $customId = $currentTime;
        $jbt = new Mjbt();
        $data = [
            'id'=>$customId,
            'jabatan' => $this->request->getPost('jabatan'),
            'desk' => $this->request->getPost('desk'),
           
        ];

        $jbt->insert($data);
      
        return redirect()->to('Data-Pegawai')->with('success', 'Data sukses ditambah');
    }
    

    public function edit(){

        $user = new Muser();
        $id = $this->request->getPost('id');
        $jabatanModel = new Mjbt();
        $data ['jabatan'] = $jabatanModel->findAll();
        $data['user'] = $user->find($id); // Mengambil data karyawan berdasarkan ID
        $data['title'] = 'Edit Data Pegawai'; // Judul halaman dinamis
       
        return view('admin/editpg', $data);
    }

    public function update($id)
    {
        $id_jabatan = $this->request->getPost('id_jabatan');
        $jabatanModel = new Mjbt();
        $jabatan = $jabatanModel->find($id_jabatan);
        
        $userModel = new Muser();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'nip' => $this->request->getPost('nip'),
            'alamat' => $this->request->getPost('alamat'),
            'id_level' => $this->request->getPost('id_level'),
            'id_jabatan' => $id_jabatan,
        ];
        
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = md5($password, PASSWORD_DEFAULT);
        }
    
        $userModel->update($id, $data);
    
        return redirect()->to('Data-Pegawai')->with('success', 'Data updated successfully!');
    }
    

    public function delete($id){
        $user = new Muser();
        $user->delete($id);

        // Redirect kembali ke halaman data karyawan setelah penghapusan berhasil
        return redirect()->to('Data-Pegawai')->with('success', 'Data berhasil di hapus');
    }

    public function vlistuser()
    {
        if (session()->get('logged_in') && session()->get('id_level') === '1') {
            $userModel = new Muser();
            $jbt = new Mjbt();
            
            $users = $userModel->findAll();
            $data = [
                'title' => 'Data Pegawai laporan Koperasi',
                'users' => []
            ];
            
            foreach ($users as $user) {
                if ($user['id_level'] === '1') {
                    continue;
                }
                
                $jabatan = $jbt->find($user['id_jabatan']);
                $jabatanPegawai = $jabatan ? $jabatan['jabatan'] : 'Unknown Jabatan';
                $user['jabatan'] = $jabatanPegawai;
                $data['users'][] = $user;
            }
    
            return view('admin/laporan', $data);
        } else {
            return redirect()->back();
        }
    }

    public function vkurja($id_user){
        if (session()->get('logged_in') && session()->get('id_level') === '1') {
            $kinerjaModel = new Mkinerja();
            $userModel = new Muser();
            
            $user = $userModel->find($id_user);
            //$kinerja = $kinerjaModel->where('id_user', $id_user)->findAll();
            $kinerja = $kinerjaModel->filebukti($id_user);
            foreach ($kinerja as &$item) {
                $item['persentase_ktahunan'] = is_numeric($item['ktahunan_realisasi']) && is_numeric($item['ktahunan_target'])
                    ? ($item['ktahunan_realisasi'] / $item['ktahunan_target']) * 100
                    : 'N/A';
                $item['persentase_ktribulan'] = is_numeric($item['ktribulan_realisasi']) && is_numeric($item['ktribulan_target'])
                    ? ($item['ktribulan_realisasi'] / $item['ktribulan_target']) * 100
                    : 'N/A';
                $item['persentase_anggaran'] = is_numeric($item['anggaran_realisasi']) && is_numeric($item['anggaran_target'])
                    ? ($item['anggaran_realisasi'] / $item['anggaran_target']) * 100
                    : 'N/A';
            }
            
            $data = [
                'title' =>'Data Laporan Kinerja Pegawai',
                'user' => $user,
                'kinerja' => $kinerja
            ];
            
            return view('admin/lpegawai', $data);
        } else {
            return redirect()->back();
        }
    }

    public function editkinerja($id_kinerja){
        if (session()->get('logged_in') && session()->get('id_level') === '1') {
            $kinerjaModel = new Mkinerja();
            $kinerja = $kinerjaModel->find($id_kinerja);
            $userModel = new Muser();
            
            
            if ($kinerja) {
                $data = [
                    'title' => 'Edit Status Kinerja',
                    'kinerja' => $kinerja,
                   
                ];
    
                return view('admin/editlaporan', $data);
            } else {
                return redirect()->back()->with('error', 'Data Tidak Ditemukan.');
            }
        } else {
            return redirect()->to(base_url('laporan'))->with('error', 'Akses ditolak.');
        }
    }

    // public function updatestatus($id_kinerja){
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST' && session()->get('logged_in') && session()->get('id_level') === '1') {
    //         $kinerjaModel = new Mkinerja();

    //         $newStatus = $this->request->getPost('new_status');

    //         if ($newStatus === 'ditolak') {
    //             $deleted = $kinerjaModel->delete($id_kinerja);

    //             if ($deleted) {
    //                 return redirect()->to(base_url('Laporan-Pegawai'))->with('success', 'Data kinerja berhasil ditolak dan dihapus.');
    //             } else {
    //                 return redirect()->back()->with('error', 'Gagal menghapus data kinerja.');
    //             }
    //         } else {
    //             $updated = $kinerjaModel->update($id_kinerja, ['status' => $newStatus]);

    //             if ($updated) {
    //                 return redirect()->to(base_url('Laporan-Pegawai'))->with('success', 'Data kinerja berhasil di update.');
    //             } else {
    //                 return redirect()->back()->with('error', 'Gagal mengupdate status kinerja.');
    //             }
    //         }
    //     } else {
    //         return redirect()->to(base_url('laporan'))->with('error', 'Akses ditolak.');
    //     }
    // }

    // File: YourController.php

public function updatestatus($id_kinerja){
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && session()->get('logged_in') && session()->get('id_level') === '1') {
        $kinerjaModel = new Mkinerja();

        $status = $this->request->getPost('new_status');

        if ($status === 'ditolak') {
            $kinerjaData = $kinerjaModel->find($id_kinerja);
            $mbuktiModel = new Mbukti(); // Ganti dengan model Mbukti yang sesuai
            
            if ($kinerjaData) {
                // Ambil data bukti untuk mendapatkan nama file yang terkait
                $id_bukti = $kinerjaData['id_bukti'];
                $buktiData = $mbuktiModel->find($id_bukti);

                if ($buktiData) {
                    // Hapus file dari server jika ada
                    $namaFile = $buktiData['file'];
                    $pathToFile = ROOTPATH . 'writable/bukti/' . $namaFile;

                    if (file_exists($pathToFile)) {
                        unlink($pathToFile);
                    }

                    // Hapus data bukti dari database
                    $mbuktiModel->delete($id_bukti);
                }
            }
            
            // Hapus data kinerja dari database
            $hapus = $kinerjaModel->delete($id_kinerja);

            if ($hapus) {
                return redirect()->to(base_url('Laporan-Pegawai'))->with('success', 'Data kinerja berhasil ditolak dan dihapus.');
            } else {
                return redirect()->back()->with('error', 'Gagal menghapus data kinerja.');
            }
        } else {
            $updated = $kinerjaModel->update($id_kinerja, ['status' => $status]);

            if ($updated) {
                return redirect()->to(base_url('Laporan-Pegawai'))->with('success', 'Data kinerja berhasil di update.');
            } else {
                return redirect()->back()->with('error', 'Gagal mengupdate status kinerja.');
            }
        }
    } else {
        return redirect()->to(base_url('laporan'))->with('error', 'Akses ditolak.');
    }
}


    // public function hapuskinerja($id_kinerja){
    //     if (session()->get('logged_in') && session()->get('id_level') === '1') {
    //         $kinerjaModel = new Mkinerja();
            
    //         $deleted = $kinerjaModel->delete($id_kinerja);
    
    //         if ($deleted) {
    //             return redirect()->back()->with('success', 'Data kinerja berhasil dihapus.');
    //         } else {
    //             return redirect()->back()->with('error', 'Gagal menghapus data kinerja.');
    //         }
    //     } else {
    //         return redirect()->back()->with('error', 'Akses ditolak.');
    //     }
    // }

    // File: YourController.php

public function hapuskinerja($id_kinerja){
    if (session()->get('logged_in') && session()->get('id_level') === '1') {
        $kinerjaModel = new Mkinerja();
        
        // Ambil data kinerja untuk mendapatkan id_bukti yang terkait
        $kinerjaData = $kinerjaModel->find($id_kinerja);

        if ($kinerjaData) {
            // Hapus data bukti dari database
            $id_bukti = $kinerjaData['id_bukti'];
            $mbuktiModel = new Mbukti(); // Ganti dengan model Mbukti yang sesuai
            $buktiData = $mbuktiModel->find($id_bukti);

            if ($buktiData) {
                // Hapus file dari server jika ada
                $namaFile = $buktiData['file'];
                $pathToFile = ROOTPATH . 'writable/bukti/' . $namaFile;

                if (file_exists($pathToFile)) {
                    unlink($pathToFile);
                }

                // Hapus data bukti dari database
                $mbuktiModel->delete($id_bukti);
            }
        }

        // Hapus data kinerja dari database
        $deleted = $kinerjaModel->delete($id_kinerja);

        if ($deleted) {
            return redirect()->back()->with('success', 'Data kinerja dan bukti berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data kinerja dan bukti.');
        }
    } else {
        return redirect()->back()->with('error', 'Akses ditolak.');
    }
}


    public function subkinerja($id_kinerja){
        
        $subkinerjaModel = new Msub();
        $subkinerja = $subkinerjaModel->where('id_kinerja', $id_kinerja)->findAll();

        $data = [
            'title' => 'Data Sub-Kinerja',
            'subkinerja' => $subkinerja
        ];

        return view('admin/subkinerja', $data);
    }
    public function editsub($id_sub){
        $subKinerjaModel = new Msub();
        $subItem = $subKinerjaModel->find($id_sub);

        if (!$subItem) {
            return redirect()->back()->with('error', 'Subkinerja not found');
        }

        $data = [
            'title' => 'Edit Subkinerja',
            'subItem' => $subItem,
        ];

        return view('admin/editsub', $data);
    }

    public function updatesub($id_sub){
        $subKinerjaModel = new Msub();
        $subItem = $subKinerjaModel->find($id_sub);
    
        if (!$subItem) {
            return redirect()->back()->with('error', 'Subkinerja not found');
        }
    
        $newStatus = $this->request->getVar('status'); // Ambil status dari form
    
        if ($newStatus === 'diterima' || $newStatus === 'ditolak') {
            $subItem['status'] = $newStatus;
            $subKinerjaModel->save($subItem);
    
            return redirect()->to('Laporan-Pegawai')->with('success', 'Status Sukses Di Update');
        } else {
            return redirect()->back()->with('error', 'Gagal Update Status');
        }
    }
    
}