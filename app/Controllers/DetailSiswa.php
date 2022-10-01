<?php

namespace App\Controllers;

use App\Models\ModelDetailGuru;
use App\Models\ModelDetailSiswa;
use App\Models\ModelKelas;
use App\Models\ModelMapel;

class DetailSiswa extends BaseController
{
    public function __construct()
    {
        $this->model = new ModelMapel;
        $this->modelKelas = new ModelKelas;
        $this->modelDetailSiswa = new ModelDetailSiswa;
        $this->modelDetailGuru = new ModelDetailGuru;
    }

    public function list_mapel_siswa(){
        $data = [
            'mapel_siswa' => $this->modelDetailSiswa->getMapelByIdKelas(session()->get('id_kelas'))
        ];

        // dd($data['mapel_siswa']);
        return view('v_siswa/list_mapel/index', $data);
    }

    public function showMateriForSiswa($get_IdDetailKelas){
        $data = [
            'detailKelas' => $this->modelDetailSiswa->getDetailKelasById($get_IdDetailKelas),
            'listMateri' => $this->modelDetailSiswa->getMateri($get_IdDetailKelas)
        ];
        return view('v_siswa/materi/index', $data);
    }

    public function showDetailMateriForSiswa($get_idMateri){
        $data = [
            'materi' => $this->modelDetailGuru->getMateriById($get_idMateri),
            'tugas' => $this->modelDetailGuru->getTugasByIdMateri($get_idMateri),
            'kuis' => $this->modelDetailGuru->getKuisByIdMateri($get_idMateri),
        ];
        // dd($data['tugas']);
        return view('v_siswa/materi/detail_materi', $data);
    }

    public function showDetailTugasForSiswa($get_idTugas, $get_IdDetailKelas, $get_idMateri){
        $data = [
            'validation' => $this->validation,
            'detailKelas' => $this->modelDetailGuru->getDetailKelasById($get_IdDetailKelas),
            'materi' => $this->modelDetailGuru->getMateriById($get_idMateri),
            'tugas' => $this->modelDetailGuru->getTugasById($get_idTugas),
        ];
        // dd($data['tugas']);
        return view('v_siswa/materi/detail_tugas', $data);
    }

    public function submitTugasSiswa(){
        $id_tugas = $this->request->getPost('id_tugas');
        $id_detail_kelas = $this->request->getPost('id_detail_kelas');
        $id_materi = $this->request->getPost('id_materi');
        $id_siswa = session()->get('id_siswa');
        $date = date('Y-m-d');

        if (!$this->validate([
            'isi_tugas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jawaban harus diisi'
                ]
            ]
        ])){
            return redirect()->to(base_url('detailsiswa/showDetailTugasForSiswa/'.$id_tugas.'/'.$id_detail_kelas.'/'.$id_materi))->withInput()->with('validation', $this->validation);
        }

        if (is_uploaded_file($fileTugasSiswa = $this->request->getFile('file_tugas_siswa'))) {
            //Pindah ke folder 'file_uploads'
            $fileTugasSiswa->move('file_uploads/file_tugas_siswa');
            // ambil nama File
            $namaFile = $fileTugasSiswa->getName();
            
        }else{
            $namaFile = '';
        } 

        $data = [
            'id_tugas' => $id_tugas,
            'id_siswa' => $id_siswa,
            'isi_tugas_siswa' => $this->request->getPost('isi_tugas'),
            'file_tugas_siswa' => $namaFile,
            'tanggal_kumpul_siswa' => $date
        ];

        $insert_tugas_siswa = $this->modelDetailSiswa->submitTugas($data);

        if($insert_tugas_siswa){
            session()->setFlashdata('message', 'Berhasil Mengumpulkan Tugas');
            return redirect()->to(base_url('detailsiswa/showDetailMateriForSiswa/'.$id_materi));
        }
    }

    public function downloadFileMateriForSiswa($get_idMateri){
        $file = $this->modelDetailGuru->getMateriById($get_idMateri);
        return $this->response->download('file_uploads/'.$file->file_uploads,null);
    }

    public function downloadFileTugasForSiswa($get_idTugas){
        $file = $this->modelDetailGuru->getTugasById($get_idTugas);
        return $this->response->download('file_uploads/file_tugas/'.$file->file_tugas,null);
    }

    public function showDetailKuisForSiswa($get_idKuis, $get_IdDetailKelas, $get_idMateri){
        $data = [
            'validation' => $this->validation,
            'detailKelas' => $this->modelDetailGuru->getDetailKelasById($get_IdDetailKelas),
            'materi' => $this->modelDetailGuru->getMateriById($get_idMateri),
            'kuis' => $this->modelDetailGuru->getDetailKuisByIdKuis($get_idKuis),
            'id_kuis' => $get_idKuis
        ];
        // dd($data['kuis']);
        return view('v_siswa/materi/detail_kuis', $data);
    }

    public function submitKuisSiswa(){
        $id_materi = $this->request->getPost('id_materi');
        $id_kuis = $this->request->getPost('id_kuis');
        $jawaban = $this->request->getPost('jawaban');
        $benar = 0;
        foreach($jawaban as $id_detail_kelas => $jawab){
            $data_soal = $this->modelDetailSiswa->getDetailKuisByIdDetailKuis($id_detail_kelas);
            if ($data_soal->kunci_jawaban == $jawab) {
                $benar++;
            }
            // echo '<pre>'; var_dump($data_soal); echo '</pre>';
        }
        $jumlah_soal = countSoalFromDetailKuis($id_kuis);
        $jumlah_benar = $benar;
        $jumlah_salah = $jumlah_soal-$jumlah_benar;
        $nilai = $benar/$jumlah_soal;
        $total_nilai = intval($nilai*100);

        $id_siswa = session()->get('id_siswa');

        $data = [
            'id_siswa' => $id_siswa,
            'id_kuis' => $id_kuis,
            'jumlah_benar' => $jumlah_benar,
            'jumlah_salah' => $jumlah_salah,
            'nilai' => $total_nilai
        ];

        $insert_kuis_siswa = $this->modelDetailSiswa->submitKuis($data);

        if($insert_kuis_siswa){
            session()->setFlashdata('message', 'Berhasil Mengumpulkan Kuis');
            return redirect()->to(base_url('detailsiswa/showDetailMateriForSiswa/'.$id_materi));
        }
    }

    public function updateKuisSiswa(){
        $id_materi = $this->request->getPost('id_materi');
        $id_nilai_kuis = $this->request->getPost('id_nilai_kuis');
        $id_kuis = $this->request->getPost('id_kuis');
        $jawaban = $this->request->getPost('jawaban');
        $nilai_siswa = getNilaiKuisSiswa(session()->get('id_siswa'), $id_kuis);

        $benar = 0;
        foreach($jawaban as $id_detail_kelas => $jawab){
            $data_soal = $this->modelDetailSiswa->getDetailKuisByIdDetailKuis($id_detail_kelas);
            if ($data_soal->kunci_jawaban == $jawab) {
                $benar++;
            }

        }
        $jumlah_soal = countSoalFromDetailKuis($id_kuis);
        $jumlah_benar = $benar;
        $jumlah_salah = $jumlah_soal-$jumlah_benar;
        $nilai = $benar/$jumlah_soal;
        $total_nilai = intval($nilai*100);

        $id_siswa = session()->get('id_siswa');
        
        if ($nilai_siswa->nilai > $total_nilai) {
            $total_nilai = $nilai_siswa->nilai;
        }

        $data = [
            'id_nilai_kuis' => $id_nilai_kuis,
            'jumlah_benar' => $jumlah_benar,
            'jumlah_salah' => $jumlah_salah,
            'nilai' => $total_nilai
        ];

        $update_kuis_siswa = $this->modelDetailSiswa->updateKuis($data);

        if($update_kuis_siswa){
            session()->setFlashdata('message', 'Berhasil Mengumpulkan Kuis');
            return redirect()->to(base_url('detailsiswa/showDetailMateriForSiswa/'.$id_materi));
        }
    }
}