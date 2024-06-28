<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BarangModel;
use App\Models\KategoriModel;


class Barang_Masuk extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;
    private $dataList = [];

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
        $this->dataList = $this->loadExistingData();
    }

    public function index()
    {
        $data = [
            'barang' => $this->barangModel->findAll(),
            'kategori' => $this->kategoriModel->findAll()
        ];
        echo view('v_header');
        return view('v_barang_masuk', $data);
    }
    public function loadExistingData()
    {
        session();

        return session()->get('datalist') ?? [];
    }
    public function saveData()
    {
        if ($this->barangModel->find($this->request->getVar('id_barang')) == null) {
            $data2 = [
                'id_barang' => $this->request->getVar('id_barang'),
                'nama' => $this->request->getVar('nama'),
                'satuan' => $this->request->getVar('satuan'),
                'merk' => $this->request->getVar('merk'),
                'stok' => $this->request->getVar('stok'),
                'harga_beli' => $this->request->getVar('harga_beli'),
                'id_kategori' => $this->request->getVar('id_kategori'),
            ];
            $this->dataList[] = $data2;
            session()->set('datalist', $this->dataList);
            return redirect()->to(base_url('/barang/index'));
        } else {
            return redirect()->to(base_url('/barang/index'));
        }
    }
}
