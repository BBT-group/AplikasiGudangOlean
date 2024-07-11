<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use Config\Pager;

class Stok extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function index(): string
    {

        $keyword = $this->request->getVar('search');
        if ($keyword) {
            $barang = $this->barangModel->getBarangByName($keyword);
        } else {
            $barang = $this->barangModel;
        }
        $data = [
            'barang' => $barang->getBarangWithKategori(),
            'pager' => $this->barangModel->pager
        ];
        echo view('v_header');
        return view('v_stok', $data);
    }

    // fungsi ke detail barang
    public function indexDetail()
    {
        $data = [
            'barang' => $this->barangModel->getBarangById($this->request->getVar('id_barang')),
        ];
        return view('admin\percobaan', $data);
    }

    // fungsi update barang
    public function updateBarang()
    {

        $file = $this->request->getFile('foto');
        if ($file->isValid() && !$file->hasMoved()) {
            $dataLama = $this->barangModel->getBarangById($this->request->getVar('id_barang'));
            $fotoLama = $dataLama['foto'];
            unlink($fotoLama);
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName);
            $foto_path = 'uploads/' . $newName;
            $newID = $this->kategoriModel->where('nama_kategori', $this->request->getVar('id_kategori'))->first();
            $data = [
                'id_barang' => $this->request->getVar('id_barang'),
                'nama' => $this->request->getVar('nama'),
                'satuan' => $this->request->getVar('satuan'),
                'foto' => $foto_path,
                'merk' => $this->request->getVar('merk'),
                'stok' => $this->request->getVar('merk'),
                'harga_beli' => $this->request->getVar('merk'),
                'id_kategori' => $newID['id_kategori'],
            ];
            $this->barangModel->update($this->request->getVar('id_barang'), $data);
            return redirect()->to(base_url('/stok'));
        } else {
            $newID = $this->kategoriModel->where('nama_kategori', $this->request->getVar('id_kategori'))->first();
            $data = [
                'id_barang' => $this->request->getVar('id_barang'),
                'nama' => $this->request->getVar('nama'),
                'satuan' => $this->request->getVar('satuan'),
                'foto' => $this->request->getVar('foto'),
                'merk' => $this->request->getVar('merk'),
                'stok' => $this->request->getVar('merk'),
                'harga_beli' => $this->request->getVar('merk'),
                'id_kategori' => $newID['id_kategori'],
            ];
            $this->barangModel->update($this->request->getVar('id_barang'), $data);
            return redirect()->to(base_url('/stok'));
        }
    }
}
