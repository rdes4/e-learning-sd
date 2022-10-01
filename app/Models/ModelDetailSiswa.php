<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDetailSiswa extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function getMapelByIdKelas($id_kelas){
        $query = $this->db->table('tb_detail_kelas')
        ->join('tb_kelas', 'tb_kelas.id_kelas = tb_detail_kelas.id_kelas')
        ->join('tb_guru', 'tb_guru.id_guru = tb_detail_kelas.id_guru')
        ->join('tb_mapel', 'tb_mapel.id_mapel = tb_detail_kelas.id_mapel')
        ->getWhere(['tb_detail_kelas.id_kelas' => $id_kelas]);

        if ($query->resultID->num_rows > 0) {
            return $query->getResultArray();
        }
    }

    public function getDetailKelasById($id_detail_kelas){
        $query = $this->db->table('tb_detail_kelas')
        ->join('tb_kelas', 'tb_kelas.id_kelas = tb_detail_kelas.id_kelas')
        ->join('tb_guru', 'tb_guru.id_guru = tb_detail_kelas.id_guru')
        ->join('tb_mapel', 'tb_mapel.id_mapel = tb_detail_kelas.id_mapel', 'left')
        ->getWhere(['tb_detail_kelas.id_detail_kelas' => $id_detail_kelas]);

        if ($query->resultID->num_rows > 0) {
            return $query->getRow();
        }
    }

    public function getMateri($id_detail_kelas){
        $query = $this->db->table('tb_materi')->getWhere(['id_detail_kelas' => $id_detail_kelas]);
        if ($query->resultID->num_rows > 0) {
            return $query->getResultArray();
        }
    }

    public function submitTugas($data){
        return $this->db->table('tb_tugas_siswa')->insert($data);
    }

    public function getDetailKuisByIdDetailKuis($id_detail_kuis){
        $query = $this->db->table('tb_detail_kuis')->getWhere(['id_detail_kuis' => $id_detail_kuis]);
        if ($query->resultID->num_rows > 0) {
            return $query->getRow();
        }
    }

    public function submitKuis($data){
        return $this->db->table('tb_nilai_kuis')->insert($data);
    }

    public function updateKuis($data){
        return $this->db->table('tb_nilai_kuis')->where('id_nilai_kuis', $data['id_nilai_kuis'])->update($data);
    }
    
}