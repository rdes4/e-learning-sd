<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelGuru extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function getGuruById($id_guru){
        $query = $this->db->table('tb_guru')->getWhere(['id_guru' => $id_guru]);
        if ($query->resultID->num_rows > 0) {
            return $query->getRow();
        }
        
    }

    public function getDataGuru(){
        return $this->db->table('tb_guru')->get()->getResultArray();
    }

    public function addGuru($data){
        return $this->db->table('tb_guru')->insert($data);
    }

    public function editGuru($data){
        return $this->db->table('tb_guru')->where('id_guru', $data['id_guru'])->update($data);
    }

    public function deleteGuru($data){
        return $this->db->table('tb_guru')->where('id_guru', $data['id_guru'])->delete($data);
    }
}