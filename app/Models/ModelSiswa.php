<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSiswa extends Model
{
        
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function getSiswa($id_siswa){
        $query = $this->db->table('tb_siswa')->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas')->getWhere(['id_siswa' => $id_siswa]);
        if ($query->resultID->num_rows > 0) {
            return $query->getRow();
        }
        
    }

    public function getDataSiswa(){
        return $this->db->table('tb_siswa')->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas')->get()->getResultArray();
    }

    public function addSiswa($data){
        return $this->db->table('tb_siswa')->insert($data);
    }

    public function editSiswa($data){
        return $this->db->table('tb_siswa')->where('id_siswa', $data['id_siswa'])->update($data);
    }

    public function deleteSiswa($data){
        return $this->db->table('tb_siswa')->where('id_siswa', $data['id_siswa'])->delete($data);
    }

    public function getDataSiswaByKelas($id_kelas){
        $query = $this->db->table('tb_siswa')->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas')->where(['tb_kelas.id_kelas' => $id_kelas])->countAllResults();
        return $query;
    }
    
}