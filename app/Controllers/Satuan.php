<?php

namespace App\Controllers;



use App\Models\SatuanModel;




class Barang_Keluar extends BaseController
{

    protected $satuanModel;


    public function __construct()
    {

        $this->satuanModel = new SatuanModel();
    }

    public function index()
    {
        $data = [
            'satuan' => $this->satuanModel->findAll()
        ];
        return view('', $data);
    }

    public function indexTambah()
    {

        return view('');
    }

    public function tambahSatuan()
    {
        $this->satuanModel->insert(['nama_satuan' => $this->request->getVar('nama_satuan')]);
        return redirect()->to('');
    }

    public function indexUpdate()
    {
        $data = [
            'satuan' => $this->satuanModel->where('id_satuan', $this->request->getVar('id_satuan'))->first()
        ];
        return view('', $data);
    }

    public function updateSatuan()
    {
        $this->satuanModel->update($this->request->getVar('id_satuan'), ['nama_satuan' => $this->request->getVar('nama_satuan')]);
        return redirect()->to('');
    }
}
