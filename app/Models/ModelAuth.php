<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuth extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function loginAdmin($username, $password){
        return $this->db->table('tb_admin')->where([
            'username' => $username,
            'password' => $password
        ])->get()->getRowArray();
    }

    public function loginGuru($nip, $pass){
        return $this->db->table('tb_guru')->where([
            'nip' => $nip,
            'pass' => $pass
        ])->get()->getRowArray();
    }

    public function loginSiswa($nis, $pass){
        return $this->db->table('tb_siswa')->where([
            'nis' => $nis,
            'pass' => $pass
        ])->get()->getRowArray();
    }

}