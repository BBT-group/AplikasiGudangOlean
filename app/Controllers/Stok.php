<?php

namespace App\Controllers;

class Stok extends BaseController
{
    public function index(): string
    {
        echo view('v_header');
        return view('v_stok');
    }
}