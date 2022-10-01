<?php 

function cekMapel($id_kelas, $id_mapel){
    $db = \Config\Database::connect();
    $query = $db->table('tb_detail_kelas')->getWhere([
        'id_kelas' => $id_kelas,
        'id_mapel' => $id_mapel
    ]);

    if ($query->resultID->num_rows > 0) {
        return "disabled";
    }
}

function cekMapelAgain($id_kelas, $id_mapel){
    $db = \Config\Database::connect();
    $query = $db->table('tb_detail_kelas')->getWhere([
        'id_kelas' => $id_kelas,
        'id_mapel' => $id_mapel
    ]);

    if ($query->resultID->num_rows > 0) {
        return 1;
    }else{
        return 0;
    }
}

function getDetailKelas($id_kelas, $id_mapel){
    $db = \Config\Database::connect();
    $result = $db->table('tb_detail_kelas')
    ->join('tb_guru', 'tb_guru.id_guru = tb_detail_kelas.id_guru')
    ->getWhere([
        'id_kelas' => $id_kelas,
        'id_mapel' => $id_mapel
    ])->getRow();

    return $result;
}

function getTugasSiswaByIdSiswa($id_siswa, $id_tugas){
    $db = \Config\Database::connect();
    $result = $db->table('tb_tugas_siswa')
    ->getWhere([
        'id_siswa' => $id_siswa,
        'id_tugas' => $id_tugas
    ])->getRow();

    return $result;
}

function countSoalFromDetailKuis($id_kuis){
    $db = \Config\Database::connect();
    $result = $db->table('tb_detail_kuis')
    ->where([
        'id_kuis' => $id_kuis
    ])->countAllResults();

    return $result;
}

function getNilaiKuisSiswa($id_siswa, $id_kuis){
    $db = \Config\Database::connect();
    $result = $db->table('tb_nilai_kuis')
    ->getWhere([
        'id_siswa' => $id_siswa,
        'id_kuis' => $id_kuis
    ])->getRow();

    return $result;
}

?>