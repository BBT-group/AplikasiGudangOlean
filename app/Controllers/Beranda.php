<?php

namespace App\Controllers;
use App\Models\BarangModel;
use App\Models\InventarisModel;

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
        $data = [
            'jumlah_barang' => $this->barangModel->getBarangCount(),
            'jumlah_alat' => $this->inventarisModel->getAlatCount(),
        ];
        echo view('v_header');
        return view('v_dashboard', $data);
    }
}