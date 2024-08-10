<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\InventarisModel;
use App\Models\KategoriModel;
use App\Models\SatuanModel;

class Beranda extends BaseController
{
    protected $barangModel;
    protected $inventarisModel;
    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->inventarisModel = new inventarisModel();
    }
    public function index(): string
    {
        $satuan = new SatuanModel();
        $kategori = new KategoriModel();
        $data = [
            'jumlah_barang' => $this->barangModel->getBarangCount(),
            'jumlah_alat' => $this->inventarisModel->getAlatCount(),
            'jumlah_satuan' => $satuan->countAll(),
            'jumlah_kategori' => $kategori->countAll(),
        ];
        echo view('v_header');
        return view('v_dashboard', $data);
    }
}
