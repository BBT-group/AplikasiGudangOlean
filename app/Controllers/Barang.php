<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BarangModel;

class Barang extends Controller
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

        return view('admin\index', $data);
    }

    public function simpan()
    {
        $file = $this->request->getFile('foto');
        if ($file->isValid() && $file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName);
            $foto_path = 'uploads/' . $newName;

            $data = [
                'id_barang' => $this->request->getPost('id_barang'),
                'nama' => $this->request->getPost('nama'),
                'satuan' => $this->request->getPost('satuan'),
                'foto' => $foto_path,
                'merk' => $this->request->getPost('merk'),
                'stok' => $this->request->getPost('stok'),
                'harga_beli' => $this->request->getPost('harga_beli'),
                'id_kategori' => $this->request->getPost('id_kategori'),
            ];

            $this->barangModel->save($data);
            return redirect()->to(base_url('/'));
        } else {
            $data['error'] = $file->getErrorString();
            return view('admin/index', $data);
        }
    }
}
