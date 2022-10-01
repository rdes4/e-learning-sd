<?php 

namespace App\Controllers;

use App\Models\ModelGuru;
use CodeIgniter\Validation\Rules;

class Guru extends BaseController
{
    public function __construct()
    {
        $this->model = new ModelGuru;
    }
    
    public function index()
    {

        $data = [
            'guru' => $this->model->getDataGuru()
        ];

        return view('guru/index', $data);
    }

    public function create(){
        session();
        $data = [
            'validation' => $this->validation
        ];
        return view('guru/add_guru', $data);
    }

    public function save_guru(){

        if (!$this->validate([
            'nip' => [
                'rules' => 'required|is_unique[tb_guru.nip]',
                'errors' => [
                    'required' => 'NIP harus diisi',
                    'is_unique' => 'NIP sudah terdaftar'
                ]
            ],
            'nama_guru' => [
                'rules' => 'required|',
                'errors' => [
                    'required' => 'Nama Guru harus diisi'
                ]
            ]
        ])){
            return redirect()->to(base_url('guru/create'))->withInput()->with('validation', $this->validation);
        }

        $data = [
            'nip' =>$this->request->getPost('nip'),
            'nama_guru' =>$this->request->getPost('nama_guru'),
            'pass' =>$this->request->getPost('pass')
        ];
        
        $insert_data_guru = $this->model->addGuru($data);

        if($insert_data_guru){
            session()->setFlashdata('message', 'Data Berhasil Ditambah');
            return redirect()->to(base_url('guru'));
        }

    }

    public function editGuru($id){
        $data = [
            'validation' => $this->validation,
            'guru' => $this->model->getGuruById($id)
        ];
        return view('guru/edit_guru', $data);
    }

    public function updateguru($id_guru){

        $guru_lama = $this->model->getGuruById($id_guru);
        if($guru_lama->nip == $this->request->getVar('nip')){
            $rule_nip = 'required';
        }else{
            $rule_nip = 'required|is_unique[tb_siswa.nis]';
        }

        if (!$this->validate([
            'nip' => [
                'rules' => $rule_nip,
                'errors' => [
                    'required' => 'NIP harus diisi',
                    'is_unique' => 'NIP sudah terdaftar'
                ]
            ],
            'nama_guru' => [
                'rules' => 'required|',
                'errors' => [
                    'required' => 'Nama Guru harus diisi'
                ]
            ]
        ])){
            return redirect()->to(base_url('guru/editguru/'.$id_guru))->withInput()->with('validation', $this->validation);
        }

        $data = [
            'id_guru' => $id_guru,
            'nip' =>$this->request->getPost('nip'),
            'nama_guru' =>$this->request->getPost('nama_guru'),
            'pass' =>$this->request->getPost('pass')
        ];
        
        $insert_data_guru = $this->model->editGuru($data);

        if($insert_data_guru){
            session()->setFlashdata('message', 'Data Berhasil Diubah');
            return redirect()->to(base_url('guru'));
        }

    }

    public function deleteGuru($id_guru){
        $data = [
            'id_guru' => $id_guru
        ];

        $this->model->deleteGuru($data);
        session()->setFlashdata('message', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('guru'));
    }
}