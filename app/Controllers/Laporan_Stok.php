<?php

namespace App\Controllers;

class Laporan_Stok extends BaseController
{
    public function index(): string
    {
        echo view('v_header');
        return view('v_laporan_stok');
    }
}