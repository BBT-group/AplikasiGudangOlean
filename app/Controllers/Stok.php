<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use Config\Pager;

class Stok extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function index(): string
    {

        $keyword = $this->request->getVar('search');
        if ($keyword) {
            $barang = $this->barangModel->getBarangByName($keyword);
        } else {
            $barang = $this->barangModel;
        }
        $data = [
            'barang' => $barang->findAll(),
            'kategori' => $this->kategoriModel->findAll(),
            'pager' => $this->barangModel->pager
        ];
        echo view('v_header');
        return view('v_stok', $data);
    }
}
