<?php

namespace App\Controllers;



use App\Models\KategoriModel;



class Kategori extends BaseController
{

    protected $kategoriModel;


    public function __construct()
    {

        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'kategori' => $this->kategoriModel->findAll()
        ];
        return view('', $data);
    }

    public function tambahKategori()
    {
        $this->kategoriModel->insert(['nama_kategori' => $this->request->getVar('nama_kategori')]);
        return redirect()->to('');
    }

    public function indexUpdate()
    {
        $data = [
            'kategori' => $this->kategoriModel->where('id_kategori', $this->request->getVar('id_kategori'))->first()
        ];
        return view('', $data);
    }

    public function indexTambah()
    {

        return view('');
    }


    public function updateKategori()
    {
        $this->kategoriModel->update($this->request->getVar('id_kategori'), ['nama_kategori' => $this->request->getVar('nama_kategori')]);
        return redirect()->to('');
    }
}
