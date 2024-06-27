<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BarangModel;
use App\Models\KategoriModel;



class Barang_Tambah extends Controller
{
    protected $barangModel;
    protected $kategoriModel;
    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'barang' => $this->barangModel->findAll(),
            'kategori' => $this->kategoriModel->findAll()
        ];
        echo view('v_header');
        return view('v_tambah_barang', $data);
    }
    public function simpan()
    {
        $file = $this->request->getFile('foto');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName);
            $foto_path = 'uploads/' . $newName;
            // Check if the record exists
            $existingRecord = $this->kategoriModel->where('nama_kategori', strtolower($this->request->getVar('id_kategori')))->first();
            if ($existingRecord) {
                // Update the existing record
                $this->kategoriModel->update($existingRecord['id_kategori'], $existingRecord);
            } else {
                // Insert a new record
                $this->kategoriModel->insert(['nama_kategori' => $this->request->getVar('id_kategori')]);
            }
            $newID = $this->kategoriModel->where('nama_kategori', strtolower($this->request->getVar('id_kategori')))->first();
            $data = [
                'id_barang' => $this->request->getVar('id_barang'),
                'nama' => $this->request->getVar('nama'),
                'satuan' => $this->request->getVar('satuan'),
                'foto' => $foto_path,
                'merk' => $this->request->getVar('merk'),
                'stok' => $this->request->getVar('stok'),
                'harga_beli' => $this->request->getVar('harga_beli'),
                'id_kategori' => $newID['id_kategori'],
            ];
            return redirect()->to(base_url('/stok/index'));
        }
    }
}
