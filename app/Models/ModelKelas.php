<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKelas extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function getDataKelas(){
        return $this->db->table('tb_kelas')->get()->getResultArray();
    }

    public function addKelas($data){
        return $this->db->table('tb_kelas')->insert($data);
    }

    public function getKelasById($id_kelas){
        $query = $this->db->table('tb_kelas')->getWhere(['id_kelas' => $id_kelas]);
        if ($query->resultID->num_rows > 0) {
            return $query->getRow();
        }  
    }

    public function editKelas($data){
        return $this->db->table('tb_kelas')->where('id_kelas', $data['id_kelas'])->update($data);
    }

    public function deleteKelas($data){
        return $this->db->table('tb_kelas')->where('id_kelas', $data['id_kelas'])->delete($data);
    }

    // Model Detail Kelas

    public function addDetailKelas($data){
        return $this->db->table('tb_detail_kelas')->insert($data);
    }

    public function getDetailKelas($id_kelas){
        $query = $this->db->table('tb_detail_kelas')
        ->join('tb_kelas', 'tb_kelas.id_kelas = tb_detail_kelas.id_kelas')
        ->join('tb_guru', 'tb_guru.id_guru = tb_detail_kelas.id_guru')
        ->join('tb_mapel', 'tb_mapel.id_mapel = tb_detail_kelas.id_mapel', 'left')
        ->getWhere(['tb_detail_kelas.id_kelas' => $id_kelas]);

        if ($query->resultID->num_rows > 0) {
            return $query->getRow();
        }
    }

    public function getDetailKelasById($id_kelas, $id_mapel){
        return $this->db->table('tb_detail_kelas')->getWhere([
            'id_kelas' => $id_kelas,
            'id_mapel' => $id_mapel
        ]);
    }

    public function getDetailKelasByIdGuru($id_guru){
        $query = $this->db->table('tb_detail_kelas')
        ->join('tb_kelas', 'tb_kelas.id_kelas = tb_detail_kelas.id_kelas')
        ->join('tb_guru', 'tb_guru.id_guru = tb_detail_kelas.id_guru')
        ->join('tb_mapel', 'tb_mapel.id_mapel = tb_detail_kelas.id_mapel', 'left')
        ->getWhere(['tb_detail_kelas.id_guru' => $id_guru]);

        if ($query->resultID->num_rows > 0) {
            return $query->getResultArray();
        }
    }

    public function deleteDetailKelas($data){
        return $this->db->table('tb_detail_kelas')->where('id_kelas', $data['id_kelas'])->where('id_mapel', $data['id_mapel'])->delete();
    }
}