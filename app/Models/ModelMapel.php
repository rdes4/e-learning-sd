<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMapel extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function getDataMapel(){
        return $this->db->table('tb_mapel')->get()->getResultArray();
    }

    public function addMapel($data){
        return $this->db->table('tb_mapel')->insert($data);
    }

    public function getMapelById($id_mapel){
        $query = $this->db->table('tb_mapel')->getWhere(['id_mapel' => $id_mapel]);
        if ($query->resultID->num_rows > 0) {
            return $query->getRow();
        }
        
    }

    public function getMapelByType($tipe_mapel){
        $query = $this->db->table('tb_mapel')->getWhere(['tipe_mapel' => $tipe_mapel]);
        if ($query->resultID->num_rows > 0) {
            return $query->getResultArray();
        }
        
    }

    public function editMapel($data, $id){
        return $this->db->table('tb_mapel')->where('id_mapel', $id)->update($data);
    }

    public function deleteMapel($data){
        return $this->db->table('tb_mapel')->where('id_mapel', $data['id_mapel'])->delete($data);
    }

    public function listMapelOnDetailGuru($id_kelas, $id_guru){
        $query = $this->db->table('tb_detail_kelas')->getWhere(['id_kelas' => $id_kelas, 'id_guru' => $id_guru]);
        if ($query->resultID->num_rows > 0) {
            return $query->getRow();
        }
    }
}