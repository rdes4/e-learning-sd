<?php 

namespace App\Controllers;

use App\Models\ModelKelas;
use App\Models\ModelSiswa;
use CodeIgniter\Validation\Rules;

class Siswa extends BaseController
{
    public function __construct()
    {
        $this->model = new ModelSiswa;
        $this->model1 = new ModelKelas;
    }
    
    public function index()
    {

        $data = [
            'siswa' => $this->model->getDataSiswa(),
        ];

        return view('siswa/index', $data);
    }

    public function create(){
        session();
        $data = [
            'validation' => $this->validation,
            'kelas' => $this->model1->getDataKelas()
        ];
        return view('siswa/add_siswa', $data);
    }

    public function save_siswa(){

        if (!$this->validate([
            'nis' => [
                'rules' => 'required|is_unique[tb_siswa.nis]',
                'errors' => [
                    'required' => 'NIS harus diisi',
                    'is_unique' => 'NIS sudah terdaftar'
                ]
            ],
            'nama_siswa' => [
                'rules' => 'required|',
                'errors' => [
                    'required' => 'Nama siswa harus diisi'
                ]
            ],
            'tempat_lahir_siswa' => [
                'rules' => 'required|',
                'errors' => [
                    'required' => 'Tempat lahir harus diisi'
                ]
            ],
        ])){
            return redirect()->to(base_url('siswa/create'))->withInput()->with('validation', $this->validation);
        }

        $data = [
            'nis' =>$this->request->getPost('nis'),
            'nama_siswa' =>$this->request->getPost('nama_siswa'),
            'tempat_lahir_siswa' =>$this->request->getPost('tempat_lahir_siswa'),
            'tanggal_lahir_siswa' =>$this->request->getPost('tanggal_lahir_siswa'),
            'no_telp' => $this->request->getPost('no_telp'),
            'agama' =>$this->request->getPost('agama'),
            'jk' => $this->request->getPost('jk'),
            'id_kelas' => $this->request->getPost('id_kelas'),
            'pass' =>$this->request->getPost('pass'),
        ];

        
        $insert_data_siswa = $this->model->addSiswa($data);

        if($insert_data_siswa){
            session()->setFlashdata('message', 'Data Berhasil Ditambah');
            return redirect()->to(base_url('siswa'));
        }

    }

    public function editSiswa($id){
        $data = [
            'validation' => $this->validation,
            'siswa' => $this->model->getSiswa($id),
            'kelas' => $this->model1->getDataKelas()
        ];
        return view('siswa/edit_siswa', $data);
    }

    public function updateSiswa($id_siswa){

        $siswa_lama = $this->model->getSiswa($id_siswa);
        if($siswa_lama->nis == $this->request->getVar('nis')){
            $rule_nis = 'required';
        }else{
            $rule_nis = 'required|is_unique[tb_siswa.nis]';
        }

        if (!$this->validate([
            'nis' => [
                'rules' => $rule_nis,
                'errors' => [
                    'required' => 'NIS harus diisi',
                    'is_unique' => 'NIS sudah terdaftar'
                ]
            ],
            'nama_siswa' => [
                'rules' => 'required|',
                'errors' => [
                    'required' => 'Nama siswa harus diisi'
                ]
            ],
            'tempat_lahir_siswa' => [
                'rules' => 'required|',
                'errors' => [
                    'required' => 'Tempat lahir harus diisi'
                ]
            ],
        ])){
            return redirect()->to(base_url('siswa/editsiswa/'.$id_siswa))->withInput()->with('validation', $this->validation);
        }

        $data = [
            'id_siswa' => $id_siswa,
            'nis' =>$this->request->getPost('nis'),
            'nama_siswa' =>$this->request->getPost('nama_siswa'),
            'tempat_lahir_siswa' =>$this->request->getPost('tempat_lahir_siswa'),
            'tanggal_lahir_siswa' =>$this->request->getPost('tanggal_lahir_siswa'),
            'no_telp' => $this->request->getPost('no_telp'),
            'agama' =>$this->request->getPost('agama'),
            'jk' => $this->request->getPost('jk'),
            'id_kelas' => $this->request->getPost('id_kelas'),
            'pass' =>$this->request->getPost('pass'),
        ];

        $this->model->editSiswa($data);
        session()->setFlashdata('message', 'Data Berhasil Diubah');
        return redirect()->to(base_url('siswa'));

    }

    public function deleteSiswa($id_siswa){
        $data = [
            'id_siswa' => $id_siswa
        ];

        $this->model->deleteSiswa($data);
        session()->setFlashdata('message', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('siswa'));
    }
}

?>