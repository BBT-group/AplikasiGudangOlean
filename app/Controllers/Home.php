<?php

namespace App\Controllers;

use App\Models\BarangModel as barangModel;

class Home extends BaseController
{

    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }
    public function index()
    {
        $data = [
            'semua' => $this->barangModel->getBarang()
        ];
        echo view('header');
        return view('dashboard', $data);
    }
}
