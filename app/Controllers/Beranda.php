<?php

namespace App\Controllers;

class Beranda extends BaseController
{
    public function index(): string
    {
        echo view('v_header');
        return view('v_dashboard');
    }
}