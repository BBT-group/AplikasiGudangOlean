<?php

namespace App\Controllers;

class Laporan_Masuk extends BaseController
{
    public function index(): string
    {
        echo view('v_header');
        return view('v_laporan_masuk');
    }
}