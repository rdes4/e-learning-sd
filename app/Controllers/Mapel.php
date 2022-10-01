<?php 

namespace App\Controllers;

use App\Models\ModelMapel;
use CodeIgniter\Validation\Rules;

class Mapel extends BaseController
{
    public function __construct()
    {
        $this->model = new ModelMapel;
    }
    
    public function index()
    {

        $data = [
            'mapel' => $this->model->getDataMapel()
        ];

        return view('mapel/index', $data);
    }

    public function create(){
        session();
        $data = [
            'validation' => $this->validation
        ];
        return view('mapel/add_mapel', $data);
    }

    public function save_mapel(){

        if (!$this->validate([
            'mata_pelajaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Mapel harus diisi',
                ]
            ]
        ])){
            return redirect()->to(base_url('mapel/create'))->withInput()->with('validation', $this->validation);
        }

        $data = [
            'mata_pelajaran' => $this->request->getPost('mata_pelajaran'),
            'tipe_mapel' => $this->request->getPost('tipe_mapel')
        ];
        
        $insert_data_mapel = $this->model->addMapel($data);

        if($insert_data_mapel){
            session()->setFlashdata('message', 'Data Berhasil Ditambah');
            return redirect()->to(base_url('mapel'));
        }

    }

    public function editMapel($id_mapel){
        $data = [
            'validation' => $this->validation,
            'mapel' => $this->model->getMapelById($id_mapel)
        ];
        return view('mapel/edit_mapel', $data);
    }

    public function updateMapel($id_mapel){

        if (!$this->validate([
            'mata_pelajaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Mata Pelajaran harus diisi',
                ]
            ]
        ])){
            return redirect()->to(base_url('mapel/editmapel'))->withInput()->with('validation', $this->validation);
        }

        $id = $id_mapel;

        $data = [
            'id_mapel' => $id_mapel,
            'mata_pelajaran' => $this->request->getPost('mata_pelajaran'),
            'tipe_mapel' => $this->request->getPost('tipe_mapel')
        ];

        $insert_data_mapel = $this->model->editMapel($data, $id);

        if($insert_data_mapel){
            session()->setFlashdata('message', 'Data Berhasil Diubah');
            return redirect()->to(base_url('mapel'));
        }

    }

    public function deleteMapel($id_mapel){
        $data = [
            'id_mapel' => $id_mapel
        ];

        $this->model->deleteMapel($data);
        session()->setFlashdata('message', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('kelas'));
    }

    
}