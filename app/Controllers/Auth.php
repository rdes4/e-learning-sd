<?php

namespace App\Controllers;

use App\Models\ModelAuth;
use App\Models\ModelKelas;
use CodeIgniter\Validation\Rules;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->modelAuth = new ModelAuth;
        $this->modelKelas = new ModelKelas;
    }

    public function login()
    {
        return view('auth/login_choice');
    }

    public function loginAdmin(){
        return view('auth/login_admin');
    }

    public function loginGuru(){
        return view('auth/login_guru');
    }

    public function loginSiswa(){
        return view('auth/login_siswa');
    }
    
    public function loginAdminProcess(){
        if ($this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
                ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
                ],
        ])) {
            //Jika Valid
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $cek_data = $this->modelAuth->loginAdmin($username, $password);

            if ($cek_data) {
                session()->set('logAdmin', true);
                session()->set('isLogin', true);
                session()->set('nama_admin', $cek_data['nama_admin']);
                return redirect()->to(base_url());
            }else{
                session()->setFlashdata('message', 'Login Gagal, Cek Username atau Password');
                return redirect()->to(base_url('auth/loginAdmin'));
            }

        }else{
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/loginAdmin'));
        }
    }

    public function logoutAdmin(){
        session()->remove('logAdmin');
        session()->remove('isLogin');
        session()->remove('nama_admin');
        session()->setFlashdata('message', 'Login Berhasil');
        return redirect()->to(base_url('auth/login'));

    }

    public function loginGuruProcess(){
        if ($this->validate([
            'nip' => [
                'label' => 'NIP',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
                ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
                ],
        ])) {
            $nip = $this->request->getPost('nip');
            $pass = $this->request->getPost('password');

            $cek_data = $this->modelAuth->loginGuru($nip, $pass);
            
            if ($cek_data) {
                // $detail =  $this->modelKelas->getDetailKelasByIdGuru($cek_data['id_guru']);
                session()->set('logGuru', true);
                session()->set('isLogin', true);
                session()->set('nama_guru', $cek_data['nama_guru']);
                session()->set('id_guru', $cek_data['id_guru']);
                return redirect()->to(base_url('detailguru/list_mapel'));
            }else{
                session()->setFlashdata('message', 'Login Gagal, Cek NIP atau Password. <br><br>Jika lupa password harap hubungi Tata Usaha');
                return redirect()->to(base_url('auth/loginGuru'));
            }
        }else{
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/loginGuru'));
        }
    }

    public function logoutGuru(){
        session()->remove('logGuru');
        session()->remove('isLogin');
        session()->remove('nama_guru');
        session()->setFlashdata('message', 'Logut Berhasil');
        return redirect()->to(base_url('auth/login'));

    }

    public function loginSiswaProcess(){
        if ($this->validate([
            'nis' => [
                'label' => 'NIS',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
                ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
                ],
        ])) {
            $nis = $this->request->getPost('nis');
            $pass = $this->request->getPost('password');

            $cek_data = $this->modelAuth->loginSiswa($nis, $pass);
            // dd($cek_data);
            
            if ($cek_data) {
                // $detail =  $this->modelKelas->getDetailKelasByIdGuru($cek_data['id_guru']);
                session()->set('logSiswa', true);
                session()->set('isLogin', true);
                session()->set('nama_siswa', $cek_data['nama_siswa']);
                session()->set('id_siswa', $cek_data['id_siswa']);
                session()->set('id_kelas', $cek_data['id_kelas']);
                return redirect()->to(base_url('detailguru/list_mapel_siswa'));
            }else{
                session()->setFlashdata('message', 'Login Gagal, Cek NIS atau Password. <br><br>Jika lupa dengan akun, harap hubungi Wali Kelas atau Tata Usaha');
                return redirect()->to(base_url('auth/loginSiswa'));
            }
        }else{
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/loginSiswa'));
        }
    }

    public function logoutSiswa(){
        session()->remove('logSiswa');
        session()->remove('isLogin');
        session()->remove('nama_siswa');
        session()->remove('id_siswa');
        session()->setFlashdata('message', 'Logut Berhasil');
        return redirect()->to(base_url('auth/login'));

    }


}