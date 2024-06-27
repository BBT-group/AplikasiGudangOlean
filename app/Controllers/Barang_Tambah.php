<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BarangModel;
use App\Models\KategoriModel;



class Barang_Tambah extends Controller
{
    protected $barangModel;
    protected $kategoriModel;
    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'barang' => $this->barangModel->findAll(),
            'kategori' => $this->kategoriModel->findAll()
        ];
        return view('v_tambah_barang', $data);
    }
}
