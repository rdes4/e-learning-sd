<?php 

namespace App\Controllers;

use App\Models\ModelDetailGuru;
use App\Models\ModelKelas;
use App\Models\ModelMapel;
use PhpParser\Node\Stmt\Echo_;

class DetailGuru extends BaseController
{
    public function __construct(){
        $this->model = new ModelMapel;
        $this->modelKelas = new ModelKelas;
        $this->modelDetailGuru = new ModelDetailGuru;
    }
    
    public function index(){
        return view('v_guru/dashboard/index');
    }

    public function list_mapel(){
        if (session()->get('id_guru')) {
            $data = [
               'detail' => $this->modelKelas->getDetailKelasByIdGuru(session()->get('id_guru'))
            ];
        }
        return view('v_guru/list_mapel/index', $data);
    }

    public function beriMateriByIdDetailKelas($get_IdDetailKelas){
        $data = [
            'detailKelas' => $this->modelDetailGuru->getDetailKelasById($get_IdDetailKelas),
            'listMateri' => $this->modelDetailGuru->getMateri($get_IdDetailKelas)
        ];
        return view('v_guru/materi/index', $data);
    }

    public function create($get_IdDetailKelas){
        if (session()->get('id_guru')) {
            $data = [
            //    'detail' => $this->modelKelas->getDetailKelasByIdGuru(session()->get('id_guru')),
               'validation' => $this->validation,
               'detailKelas' => $this->modelDetailGuru->getDetailKelasById($get_IdDetailKelas)
            ];
        }
        return view('v_guru/materi/add_materi', $data);
    }

    public function save_materi(){

        $id = $this->request->getPost('id_detail_kelas');

        if (!$this->validate([
            'judul_materi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul Materi harus diisi'
                ]
            ]
        ])){
            return redirect()->to(base_url('detailguru/create/'.$id))->withInput()->with('validation', $this->validation);
        }

        if (is_uploaded_file($fileMateri = $this->request->getFile('file_materi'))) {
            //Pindah ke folder 'file_uploads'
            $fileMateri->move('file_uploads');
            // ambil nama File
            $namaFile = $fileMateri->getName();
            
        }else{
            $namaFile = '';
        }

        $data = [
            'judul_materi' => $this->request->getPost('judul_materi'),
            'isi_materi' => $this->request->getPost('isi_materi'),
            'link_video' => $this->request->getPost('link_video'),
            'file_uploads' => $namaFile,
            'id_detail_kelas' => $id
        ];
        
        $insert_data_materi = $this->modelDetailGuru->addMateri($data);

        if($insert_data_materi){
            session()->setFlashdata('message', 'Data Berhasil Ditambah');
            return redirect()->to(base_url('detailguru/beriMateriByIdDetailKelas/'.$id));
        }

    }

    public function showDetailMateri($get_idMateri){
        $data = [
            'materi' => $this->modelDetailGuru->getMateriById($get_idMateri),
            'tugas' => $this->modelDetailGuru->getTugasByIdMateri($get_idMateri),
            'kuis' => $this->modelDetailGuru->getKuisByIdMateri($get_idMateri),
        ];
        // dd($data['tugas']);
        return view('v_guru/materi/detail_materi', $data);
        // $tes = 'halaman baru';
        // dd($tes);
    }

    public function editMateri($get_idMateri, $get_IdDetailKelas){
        $data = [
            'detailKelas' => $this->modelDetailGuru->getDetailKelasById($get_IdDetailKelas),
            'materi' => $this->modelDetailGuru->getMateriById($get_idMateri),
            'validation' => $this->validation
        ];
        return view('v_guru/materi/edit_materi', $data);
    }

    public function update_materi(){
        $idDetailKelas = $this->request->getPost('id_detail_kelas');
        $idMateri = $this->request->getPost('id_materi');

        if (!$this->validate([
            'judul_materi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul Materi harus diisi'
                ]
            ]
        ])){
            return redirect()->to(base_url('detailguru/editMateri/'.$idMateri.'/'.$idDetailKelas))->withInput()->with('validation', $this->validation);
        }

        if (is_uploaded_file($fileMateri = $this->request->getFile('file_materi'))) {
            if ($this->request->getPost('file_uploads_lama') != '') {
                 // Hapus file sebelumnya
                unlink('file_uploads/'.$this->request->getPost('file_uploads_lama'));
            }
            //Pindah ke folder 'file_uploads'
            $fileMateri->move('file_uploads');
            // ambil nama File
            $namaFile = $fileMateri->getName();

            $data = [
                'id_materi' => $idMateri,
                'judul_materi' => $this->request->getPost('judul_materi'),
                'isi_materi' => $this->request->getPost('isi_materi'),
                'link_video' => $this->request->getPost('link_video'),
                'file_uploads' => $namaFile,
                'id_detail_kelas' => $idDetailKelas
            ];
        }else{
            $data = [
                'id_materi' => $idMateri,
                'judul_materi' => $this->request->getPost('judul_materi'),
                'isi_materi' => $this->request->getPost('isi_materi'),
                'link_video' => $this->request->getPost('link_video'),
                'id_detail_kelas' => $idDetailKelas
            ];
        }

        $update_data_materi = $this->modelDetailGuru->updateMateri($data);

        if($update_data_materi){
            session()->setFlashdata('message', 'Data Berhasil Ditambah');
            $materi = $this->modelDetailGuru->getMateriById($idMateri);
            return redirect()->to('detailguru/showDetailMateri/'.$idMateri);
        }
    }

    public function downloadFile($get_idMateri){
        $file = $this->modelDetailGuru->getMateriById($get_idMateri);
        return $this->response->download('file_uploads/'.$file->file_uploads,null);
    }

    public function deleteMateri($get_idMateri, $get_IdDetailKelas){
        $this->modelDetailGuru->deleteMateri($get_idMateri);
        session()->setFlashdata('message', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('detailguru/beriMateriByIdDetailKelas/'.$get_IdDetailKelas));
    }

    public function createTugas($get_IdDetailKelas, $get_idMateri){
        $data = [
            'detailKelas' => $this->modelDetailGuru->getDetailKelasById($get_IdDetailKelas),
            'materi' => $this->modelDetailGuru->getMateriById($get_idMateri),
            'validation' => $this->validation
        ];

        return view('v_guru/materi/add_tugas', $data);
    }

    public function save_tugas(){

        $idDetailKelas = $this->request->getPost('id_detail_kelas');
        $idKelas = $this->request->getPost('id_kelas');
        $idMateri = $this->request->getPost('id_materi');
        $date = date('d-m-y');
        $time = strtotime($this->request->getPost('tanggal_kumpul'));
        $tanggal_kumpul = date('Y-m-d', $time);

        if (!$this->validate([
            'judul_tugas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul Materi harus diisi'
                ]
            ]
        ])){
            return redirect()->to(base_url('detailguru/createTugas/'.$idDetailKelas.'/'.$idMateri))->withInput()->with('validation', $this->validation);
        }

        if (is_uploaded_file($fileTugas = $this->request->getFile('file_tugas'))) {
            //Pindah ke folder 'file_uploads'
            $fileTugas->move('file_uploads/file_tugas');
            // ambil nama File
            $namaFile = $fileTugas->getName();
            
        }else{
            $namaFile = '';
        }

        $data = [
            'judul_tugas' => $this->request->getPost('judul_tugas'),
            'isi_tugas' => $this->request->getPost('isi_tugas'),
            'file_tugas' => $namaFile,
            'tanggal_buat' => $date,
            'tanggal_kumpul' => $tanggal_kumpul,
            'id_materi' => $idMateri
        ];
        
        $insert_data_tugas = $this->modelDetailGuru->addTugas($data);

        if($insert_data_tugas){
            $data_siswa = $this->modelDetailGuru->getSiswaByIdKelas($idKelas);
            $data_kelas = $this->modelDetailGuru->getKelasById($idKelas);
            $data_materi = $this->modelDetailGuru->getMateriById($idMateri);
            $result = [];
            $limit = 0;
  
                //open connection
                $ch = curl_init();
                foreach($data_siswa as $data) {
                //set the url, number of POST vars, POST data
                curl_setopt($ch, CURLOPT_URL, 'http://api.textmebot.com/send.php?recipient=+62'.$data['no_telp'].'&apikey=tFKwNzWztZd8&text=Ada%20tugas%20baru%20di%20kelas%20'.$data_kelas->kelas.'%20pada%20materi%20'.$data_materi->judul_materi);
                //execute post
                $result[] = curl_exec($ch);
                $limit++;
                if ($limit == count($data)) {
                    sleep(0);
                }else{
                    sleep(6);
                }
                }
                //close connection
                return redirect()->to(base_url('detailguru/showDetailMateri/'.$idMateri));
                curl_close($ch);;
                
            
        }

    }

    public function showDetailTugas($get_idTugas, $get_IdDetailKelas, $get_idMateri){
        $data = [
            'validation' => $this->validation,
            'detailKelas' => $this->modelDetailGuru->getDetailKelasById($get_IdDetailKelas),
            'materi' => $this->modelDetailGuru->getMateriById($get_idMateri),
            'tugas' => $this->modelDetailGuru->getTugasById($get_idTugas),
            // 'tugas_siswa' => $this->modelDetailGuru->getTugasSiswaById($get_idTugas),
            'tugas_siswa' => $this->modelDetailGuru->getDetailTugasSiswa($get_IdDetailKelas, $get_idTugas)
        ];
        // dd($data['tugas_siswa']);
        return view('v_guru/materi/detail_tugas', $data);
    }

    public function update_tugas(){
        $idDetailKelas = $this->request->getPost('id_detail_kelas');
        $idTugas = $this->request->getPost('id_tugas');
        $idMateri = $this->request->getPost('id_materi');

        $date = date('d-m-y');
        $time = strtotime($this->request->getPost('tanggal_kumpul'));
        $tanggal_kumpul = date('Y-m-d', $time);

        if (!$this->validate([
            'judul_tugas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul Materi harus diisi'
                ]
            ]
        ])){
            return redirect()->to(base_url('detailguru/showDetailTugas/'.$idTugas.'/'.$idDetailKelas.'/'.$idMateri))->withInput()->with('validation', $this->validation);
        }


        if (is_uploaded_file($fileTugas = $this->request->getFile('file_tugas'))) {
            if ($this->request->getPost('file_uploads_lama') != '') {
                 // Hapus file sebelumnya
                unlink('file_uploads/file_tugas/'.$this->request->getPost('file_uploads_lama'));    
            }
            //Pindah ke folder 'file_uploads'
            $fileTugas->move('file_uploads');
            // ambil nama File
            $namaFile = $fileTugas->getName();

            $data = [
                'id_tugas' => $idTugas,
                'judul_tugas' => $this->request->getPost('judul_tugas'),
                'isi_tugas' => $this->request->getPost('isi_tugas'),
                'file_tugas' => $namaFile,
                'tanggal_buat' => $date,
                'tanggal_kumpul' => $tanggal_kumpul,
                'id_materi' => $idMateri
            ];
            
        }else{
            $data = [
                'id_tugas' => $idTugas,
                'judul_tugas' => $this->request->getPost('judul_tugas'),
                'isi_tugas' => $this->request->getPost('isi_tugas'),
                'tanggal_buat' => $date,
                'tanggal_kumpul' => $tanggal_kumpul,
                'id_materi' => $idMateri
            ];
        }
        
        $update_data_tugas = $this->modelDetailGuru->updateTugas($data);

        if($update_data_tugas){
            session()->setFlashdata('message', 'Data Berhasil Diubah');
            return redirect()->to(base_url('detailguru/showDetailMateri/'.$idMateri));
        }

    }

    public function deleteTugas($get_idTugas, $get_idMateri){
        $this->modelDetailGuru->deleteTugas($get_idTugas);
        session()->setFlashdata('message', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('detailguru/showDetailMateri/'.$get_idMateri));
    }

    public function downloadFileTugas($get_idTugas){
        $file = $this->modelDetailGuru->getTugasById($get_idTugas);
        return $this->response->download('file_uploads/file_tugas/'.$file->file_tugas,null);
    }

    public function detailTugasSiswa(){
        
    }

    public function updateNilaiSiswa(){
        $idDetailKelas = $this->request->getPost('id_detail_kelas');
        $idTugas = $this->request->getPost('id_tugas');
        $idMateri = $this->request->getPost('id_materi');

        $data = [
            'id_tugas_siswa' => $this->request->getPost('id_tugas_siswa'),
            'nilai_tugas_siswa' => $this->request->getPost('nilai_tugas_siswa')
        ];

        // dd($data);
        $this->modelDetailGuru->updateNilaiSiswa($data);
        return redirect()->to(base_url('detailguru/showDetailTugas/'.$idTugas.'/'.$idDetailKelas.'/'.$idMateri));
    }

    public function downloadFileTugasSiswa($get_IdTugasSiswa){
        $file = $this->modelDetailGuru->getTugasSiswaByIdTugasSiswa($get_IdTugasSiswa);
        return $this->response->download('file_uploads/file_tugas_siswa/'.$file->file_tugas_siswa,null);
    } 

    public function showDetailKuis($get_idKuis, $get_IdDetailKelas, $get_idMateri){
        $data = [
            'validation' => $this->validation,
            'detailKelas' => $this->modelDetailGuru->getDetailKelasById($get_IdDetailKelas),
            'materi' => $this->modelDetailGuru->getMateriById($get_idMateri),
            'kuis' => $this->modelDetailGuru->getDetailKuisByIdKuis($get_idKuis),
            'nilai_kuis_siswa' => $this->modelDetailGuru->getNilaiKuisSiswa($get_idKuis),
            'id_kuis' => $get_idKuis
        ];
        // dd($data['nilai_kuis_siswa']);
        return view('v_guru/materi/detail_kuis', $data);
    }

    public function createKuis($get_IdDetailKelas, $get_idMateri){
        $data = [
            'detailKelas' => $this->modelDetailGuru->getDetailKelasById($get_IdDetailKelas),
            'materi' => $this->modelDetailGuru->getMateriById($get_idMateri),
            'validation' => $this->validation
        ];

        return view('v_guru/materi/add_kuis', $data);
    }

    public function saveKuis(){
        $idDetailKelas = $this->request->getPost('id_detail_kelas');
        $idMateri = $this->request->getPost('id_materi');

        if (!$this->validate([
            'judul_kuis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul kuis harus diisi'
                ]
            ]
        ])){
            return redirect()->to(base_url('detailguru/createKuis/'.$idDetailKelas.'/'.$idMateri))->withInput()->with('validation', $this->validation);
        }

        $data = [
            'judul' => $this->request->getPost('judul_kuis'),
            'id_materi' => $idMateri
        ];

        // dd($data);
        
        $insert_data_kuis = $this->modelDetailGuru->addKuis($data);

        if($insert_data_kuis){
            session()->setFlashdata('message', 'Data Berhasil Ditambah');
            return redirect()->to(base_url('detailguru/showDetailMateri/'.$idMateri));
        }

    }

    public function deleteKuis($get_idKuis, $get_idMateri){
        $this->modelDetailGuru->deleteKuis($get_idKuis);
        session()->setFlashdata('message', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('detailguru/showDetailMateri/'.$get_idMateri));
    }

    public function save_kuis(){
        $idDetailKelas = $this->request->getPost('id_detail_kelas');
        $idMateri = $this->request->getPost('id_materi');
        $idKuis = $this->request->getPost('id_kuis');

        if (!$this->validate([
            'soal_kuis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Soal kuis harus diisi'
                ]
            ],
            'jawaban1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jawaban harus diisi'
                ]
            ],
            'jawaban2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jawaban harus diisi'
                ]
            ],
            'jawaban3' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jawaban harus diisi'
                ]
            ],
        ])){
            return redirect()->to(base_url('detailguru/showDetailKuis/'.$idKuis.'/'.$idDetailKelas.'/'.$idMateri))->withInput()->with('validation', $this->validation);
        }

        $data = [
            'id_kuis' => $idKuis,
            'soal_kuis' => $this->request->getPost('soal_kuis'),
            'jawaban1' => $this->request->getPost('jawaban1'),
            'jawaban2' =>$this->request->getPost('jawaban2'),
            'jawaban3' =>$this->request->getPost('jawaban3'),
            'kunci_jawaban' =>$this->request->getPost('kunci_jawaban')
        ];

        // dd($data);
        $insert_data_detail_kuis = $this->modelDetailGuru->addDetailKuis($data);

        if($insert_data_detail_kuis){
            session()->setFlashdata('message', 'Data Berhasil Ditambah');
            return redirect()->to(base_url('detailguru/showDetailKuis/'.$idKuis.'/'.$idDetailKelas.'/'.$idMateri));
        }
    }

    public function editKuis($get_idDetailKuis, $get_IdKuis, $get_IdDetailKelas, $get_idMateri){
        $data = [ 
            'detailKelas' => $this->modelDetailGuru->getDetailKelasById($get_IdDetailKelas),
            'materi' => $this->modelDetailGuru->getMateriById($get_idMateri),
            'kuis' => $this->modelDetailGuru->getDetailKuisByIdDetailKuis($get_idDetailKuis),
            'id_kuis' => $get_IdKuis,
            'validation' => $this->validation
        ];
        return view('v_guru/materi/edit_kuis', $data);
    }
    
    public function update_kuis(){
        $idDetailKuis = $this->request->getPost('id_detail_kuis');
        $idDetailKelas = $this->request->getPost('id_detail_kelas');
        $idMateri = $this->request->getPost('id_materi');
        $idKuis = $this->request->getPost('id_kuis');

        if (!$this->validate([
            'soal_kuis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Soal kuis harus diisi'
                ]
            ],
            'jawaban1' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jawaban harus diisi'
                ]
            ],
            'jawaban2' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jawaban harus diisi'
                ]
            ],
            'jawaban3' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jawaban harus diisi'
                ]
            ],
        ])){
            return redirect()->to(base_url('detailguru/editKuis/'.$idDetailKuis.'/'.$idKuis.'/'.$idDetailKelas.'/'.$idMateri))->withInput()->with('validation', $this->validation);
        }

        $data = [
            'id_detail_kuis' => $idDetailKuis,
            'soal_kuis' => $this->request->getPost('soal_kuis'),
            'jawaban1' => $this->request->getPost('jawaban1'),
            'jawaban2' =>$this->request->getPost('jawaban2'),
            'jawaban3' =>$this->request->getPost('jawaban3'),
            'kunci_jawaban' =>$this->request->getPost('kunci_jawaban')
        ];

        // dd($data);
        $insert_data_detail_kuis = $this->modelDetailGuru->updateDetailKuis($data);

        if($insert_data_detail_kuis){
            session()->setFlashdata('message', 'Data Berhasil Ditambah');
            return redirect()->to(base_url('detailguru/showDetailKuis/'.$idKuis.'/'.$idDetailKelas.'/'.$idMateri));
        }
    }

    public function delete_detail_kuis($get_idDetailKuis, $get_IdKuis, $get_IdDetailKelas, $get_idMateri){
        $this->modelDetailGuru->deleteDetailKuis($get_idDetailKuis);
        session()->setFlashdata('message', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('detailguru/showDetailKuis/'.$get_IdKuis.'/'.$get_IdDetailKelas.'/'.$get_idMateri)); 
    }
}