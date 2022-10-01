<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDetailGuru extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
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

    public function addMateri($data){
        return $this->db->table('tb_materi')->insert($data);
    }

    public function updateMateri($data){
        return $this->db->table('tb_materi')->where('id_materi', $data['id_materi'])->update($data);
    }

    public function getMateriById($id_detail_materi){
        $query = $this->db->table('tb_materi')->getWhere(['id_materi' => $id_detail_materi]);
        if ($query->resultID->num_rows > 0) {
            return $query->getRow();
        }
    }

    public function deleteMateri($id_materi){
        return $this->db->table('tb_materi')->where('id_materi', $id_materi)->delete();
    }

    public function addTugas($data){
        return $this->db->table('tb_tugas')->insert($data);
    }

    public function getSiswaByIdKelas($id_kelas){
        $query = $this->db->table('tb_siswa')->getWhere(['id_kelas' => $id_kelas]);
        if ($query->resultID->num_rows > 0) {
            return $query->getResultArray();
        }
    }

    public function getKelasById($id_kelas){
        $query = $this->db->table('tb_kelas')->getWhere(['id_kelas' => $id_kelas]);
        if ($query->resultID->num_rows > 0) {
            return $query->getRow();
        }  
    }

    public function getTugasByIdMateri($id_materi){
        $query = $this->db->table('tb_tugas')->getWhere(['id_materi' => $id_materi]);
        if ($query->resultID->num_rows > 0) {
            return $query->getResultArray();
        }
    }

    public function getTugasById($get_idTugas){
        $query = $this->db->table('tb_tugas')->getWhere(['id_tugas' => $get_idTugas]);
        if ($query->resultID->num_rows > 0) {
            return $query->getRow();
        }
    }

    public function updateTugas($data){
        return $this->db->table('tb_tugas')->where('id_tugas', $data['id_tugas'])->update($data);
    }

    public function deleteTugas($id_tugas){
        return $this->db->table('tb_tugas')->where('id_tugas', $id_tugas)->delete();
    }

    public function getTugasSiswaById($id_tugas){
        $query = $this->db->table('tb_tugas_siswa')->getWhere(['id_tugas' => $id_tugas]);
        if ($query->resultID->num_rows > 0) {
            return $query->getResultArray();
        }
    }

    public function getTugasSiswaByIdTugasSiswa($id_tugas_siswa){
        $query = $this->db->table('tb_tugas_siswa')->getWhere(['id_tugas_siswa' => $id_tugas_siswa]);
        if ($query->resultID->num_rows > 0) {
            return $query->getRow();
        }
    }

    public function getDetailTugasSiswa($id_detail_kelas, $id_tugas){
        $query = $this->db->table('tb_detail_kelas')
        ->join('tb_siswa', 'tb_siswa.id_kelas = tb_detail_kelas.id_kelas')
        ->join('tb_tugas_siswa', 'tb_tugas_siswa.id_siswa = tb_siswa.id_siswa')
        ->getWhere(['tb_detail_kelas.id_detail_kelas' => $id_detail_kelas, 'tb_tugas_siswa.id_tugas' => $id_tugas]);

        if ($query->resultID->num_rows > 0) {
            return $query->getResultArray();
        }
    }

    public function updateNilaiSiswa($data){
        return $this->db->table('tb_tugas_siswa')->where('id_tugas_siswa', $data['id_tugas_siswa'])->update($data);
    }

    public function getKuisByIdMateri($id_materi){
        $query = $this->db->table('tb_kuis')->getWhere(['id_materi' => $id_materi]);
        if ($query->resultID->num_rows > 0) {
            return $query->getResultArray();
        }
    }

    public function getDetailKuisByIdKuis($id_kuis){
        $query = $this->db->table('tb_detail_kuis')->getWhere(['id_kuis' => $id_kuis]);
        if ($query->resultID->num_rows > 0) {
            return $query->getResultArray();
        }
    }

    public function getDetailKuisByIdDetailKuis($id_detail_kuis){
        $query = $this->db->table('tb_detail_kuis')->getWhere(['id_detail_kuis' => $id_detail_kuis]);
        if ($query->resultID->num_rows > 0) {
            return $query->getRow();
        }
    }

    public function addKuis($data){
        return $this->db->table('tb_kuis')->insert($data);
    }

    public function deleteKuis($id_kuis){
        return $this->db->table('tb_kuis')->where('id_kuis', $id_kuis)->delete();
    }

    public function addDetailKuis($data){
        return $this->db->table('tb_detail_kuis')->insert($data);
    }

    public function updateDetailKuis($data){
        return $this->db->table('tb_detail_kuis')->where('id_detail_kuis', $data['id_detail_kuis'])->update($data);
    }

    public function deleteDetailKuis($id_detail_kuis){
        return $this->db->table('tb_detail_kuis')->where('id_detail_kuis', $id_detail_kuis)->delete();
    }

    public function getNilaiKuisSiswa($id_kuis){
        $query = $this->db->table('tb_nilai_kuis')
        ->join('tb_siswa', 'tb_siswa.id_siswa = tb_nilai_kuis.id_siswa')
        ->getWhere([
            'tb_nilai_kuis.id_kuis' => $id_kuis
        ]);
        if ($query->resultID->num_rows > 0) {
            return $query->getResultArray();
        }
    }

    

}