<?php 

namespace App\Controllers;

use App\Models\ModelKelas;
use App\Models\ModelGuru;
use App\Models\ModelMapel;
use App\Models\ModelSiswa;
use CodeIgniter\Validation\Rules;

class Kelas extends BaseController
{
    public function __construct()
    {
        $this->model = new ModelKelas;
        $this->guru = new ModelGuru;
        $this->mapel = new ModelMapel;
        $this->siswa = new ModelSiswa;
    }
    
    public function index(){

        $data = [
            'kelas' => $this->model->getDataKelas()
        ];

        return view('kelas/index', $data);
    }

    public function create(){
        session();
        $data = [
            'validation' => $this->validation,
            'guru' => $this->guru->getDataGuru()
        ];
        return view('kelas/add_kelas', $data);
    }

    public function save_kelas(){

        if (!$this->validate([
            'kelas' => [
                'rules' => 'required|is_unique[tb_kelas.kelas]',
                'errors' => [
                    'required' => 'Nama Kelas harus diisi',
                    'is_unique' => 'Kelas sudah ada'
                ]
            ]
        ])){
            return redirect()->to(base_url('kelas/create'))->withInput()->with('validation', $this->validation);
        }

        $data = [
            'kelas' => $this->request->getPost('kelas'),
            'id_guru' => $this->request->getPost('id_guru')
        ];
        
        $insert_data_kelas = $this->model->addKelas($data);


        if($insert_data_kelas){
            session()->setFlashdata('message', 'Data Berhasil Ditambah');
            return redirect()->to(base_url('kelas'));
        }

    }

    public function editKelas($id_kelas){
        $data = [
            'validation' => $this->validation,
            'kelas' => $this->model->getKelasById($id_kelas),
            'guru' => $this->guru->getDataGuru()
        ];
        return view('kelas/edit_kelas', $data);
    }

    public function updateKelas($id_kelas){

        $kelas_lama = $this->model->getKelasById($id_kelas);
        if($kelas_lama->kelas == $this->request->getVar('kelas')){
            $rule_kelas = 'required';
        }else{
            $rule_kelas = 'required|is_unique[tb_kelas.kelas]';
        }

        if (!$this->validate([
            'kelas' => [
                'rules' => $rule_kelas,
                'errors' => [
                    'required' => 'Nama Kelas harus diisi',
                    'is_unique' => 'Kelas sudah ada'
                ]
            ]
        ])){
            return redirect()->to(base_url('kelas/editkelas'))->withInput()->with('validation', $this->validation);
        }

        $data = [
            'id_kelas' => $id_kelas,
            'kelas' =>$this->request->getPost('kelas'),
            'id_guru' => $this->request->getPost('id_guru')
        ];
        
        $insert_data_kelas = $this->model->editKelas($data);

        if($insert_data_kelas){
            session()->setFlashdata('message', 'Data Berhasil Diubah');
            return redirect()->to(base_url('kelas'));
        }

    }

    public function deleteKelas($id_kelas){
        $data = [
            'id_kelas' => $id_kelas
        ];

        $this->model->deleteKelas($data);
        session()->setFlashdata('message', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('kelas'));
    }

    public function detailKelas($id_kelas){
        $data = [
            'validation' => $this->validation,
            'detail_kelas' => $this->model->getDetailKelas($id_kelas),
            'mapel' => $this->mapel->getDataMapel(),
            'mapel_umum' => $this->mapel->getMapelByType(1),
            'mapel_khusus' => $this->mapel->getMapelByType(2),
            'kelas' => $this->model->getKelasById($id_kelas),
            'guru' => $this->guru->getDataGuru(),
            'siswa' =>  $this->siswa->getDataSiswaByKelas($id_kelas)
        ];

        return view('kelas/detail_kelas', $data);

    }

    public function insertDetailKelas(){
        $data = [
            'id_kelas' => $this->request->getPost('id_kelas'),
            'id_guru' => $this->request->getPost('id_guru')
        ];

        $insert_data = $this->model->addDetailKelas($data);
        if($insert_data){
            session()->setFlashdata('message', 'Data Detail Berhasil Ditambah');
            return redirect()->to(base_url('kelas'));
        }
    }

    public function editAksesMapel($get_idKelas, $get_idMapel){
        $id_kelas = $get_idKelas;
        $id_mapel = $get_idMapel;
        $id_guru = $this->request->getPost('id_guru');

        echo $id_guru.$id_kelas.$id_mapel;

        $data = [
            'id_kelas' => $id_kelas,
            'id_guru' => $id_guru,
            'id_mapel' => $id_mapel
        ];

        $result = $this->model->getDetailKelasById($id_kelas, $id_mapel);

        if ($result->resultID->num_rows < 1) {
            $this->model->addDetailKelas($data);
            session()->setFlashdata('message', 'Akses Mata Pelajaran Diberikan');
            return redirect()->to(base_url('kelas/detailkelas/'.$id_kelas));
        }else{
            $this->model->deleteDetailKelas($data);
            session()->setFlashdata('message', 'Akses Mata Pelajaran Dihapus');
            return redirect()->to(base_url('kelas/detailkelas/'.$id_kelas));
        };
        
    }

}