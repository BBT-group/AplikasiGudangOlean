<?php

namespace App\Controllers;

class Barang_Keluar extends BaseController
{
    public function index(): string
    {
        echo view('v_header');
        return view('v_barang_keluar');
    }
}