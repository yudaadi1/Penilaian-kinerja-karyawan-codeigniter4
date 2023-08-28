<?php

namespace App\Controllers;
use App\Models\Muser;
class Auth extends BaseController
{
   
    public function login(){
        return view('login');
    }

    public function plogin(){
        $model = new Muser();
        $nip = $this->request->getPost('nip');
        $password = $this->request->getPost('password');
    
        $user = $model->where('nip', $nip)->first();
    
        if ($user) {
            $passwordHash = $user['password'];
            if (md5($password) === $passwordHash) {
                
              
                $userData = [
                    'id' => $user['id'],
                    'nip' => $user['nip'],
                    'nama' => $user['nama'],
                    'photo' => $user['photo'],
                    'id_level' => $user['id_level'],
                    'id_jabatan'=>$user['id_jabatan'],
                    'alamat' =>$user['alamat'],
                    'logged_in' => true
                ];
                session()->set($userData);
                switch ($user['id_level']) {
                    case '1':
                        return redirect()->to('Admin')->with('success', 'Login Berhasil');
                    case '2':
                        return redirect()->to('Pegawai')->with('success', 'Login Berhasil');
                  
                }
            } else {
                
                return redirect()->back()->with('error', 'Username dan Password salah');
            }
        } else {
            return redirect()->back()->with('error', 'Login Gagal silahkan periksa isian');
        }
    }

    public function logout(){
        $session = session();
    if ($session->get('logged_in')) {
        $session->destroy();
    }
        return redirect()->to('/')->with('success', 'You have been logged out successfully!');
    }
}
