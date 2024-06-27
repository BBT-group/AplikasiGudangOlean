<?php

namespace App\Controllers;

class Laporan_Keluar extends BaseController
{
    public function index(): string
    {
        echo view('v_header');
        return view('v_laporan_keluar');
    }
}