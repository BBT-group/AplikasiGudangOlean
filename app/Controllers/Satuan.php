<?php

namespace App\Controllers;

use App\Models\SatuanModel;

class Satuan extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new SatuanModel();
    }

    public function index(): string
    {
        $data['satuan'] = $this->model->orderBy('id_satuan', 'desc')->findAll();
        echo view('v_header');
        return view('v_satuan', $data);
    }

    public function tambahsatuan()
    {
        // Tampilkan view header dan form
        echo view('v_header');
        echo view('admin/v_tambah_satuan');

        if ($this->request->getMethod() === 'post') {
            $nama_satuan = $this->request->getPost('nama_satuan');

            if (empty($nama_satuan)) {
                session()->setFlashdata('error', 'Nama satuan tidak boleh kosong');
                return redirect()->back();
            }

            $data = [
                'nama_satuan' => $nama_satuan
            ];
            $this->model->tambahSatuan($data);

            return redirect()->to('/satuan')->with('success', 'Data satuan berhasil ditambahkan');
        }
    }


    public function deletesatuan($id_satuan = null)
    {
        if (!isset($id_satuan) || $this->model->find($id_satuan) == null) {
            return redirect()->to('satuan')->with('error', 'Satuan tidak ditemukan');
        } else {
            // Attempt to delete the record from the database
            if ($this->model->delete($id_satuan)) {
                return redirect()->to('satuan/index');
            } 
        }
    }
}
