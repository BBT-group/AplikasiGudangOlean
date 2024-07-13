<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;


class Inventaris extends BaseController
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
            'barang' => $this->barangModel->where('jenis', 'alat')->findAll(),
        ];
        echo view('v_header');
        return view('v_tambah_barang', $data);
    }
    public function simpan()
    {
        if (!$this->validate([
            'id_barang' => 'required|is_unique[barang.id_barang]'
        ])) {
            return redirect()->to(base_url('/barangtambah/index'));
        }

        $file = $this->request->getFile('foto');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName);
            $foto_path = 'uploads/' . $newName;
            $newID = $this->kategoriModel->where('nama_kategori', $this->request->getVar('id_kategori'))->first();
            $data = [
                'id_barang' => $this->request->getVar('id_barang'),
                'nama' => $this->request->getVar('nama'),
                'satuan' => $this->request->getVar('satuan'),
                'foto' => $foto_path,
                'jenis' => $this->request->getVar('jenis'),
                'stok' => 0,
                'harga_beli' => 0,
                'id_kategori' => $newID['id_kategori'],
            ];
            $this->barangModel->insertBarang($data);
            return redirect()->to(base_url('/stok'));
        }
    }
}
