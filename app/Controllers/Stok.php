<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\SatuanModel;
use Config\Pager;

class Stok extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;
    protected $satuanModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
        $this->satuanModel = new SatuanModel();
    }

    public function index(): string
    {

        $keyword = $this->request->getVar('search');
        if ($keyword) {
            $barang = $this->barangModel->getBarangByName($keyword);
        } else {
            $barang = $this->barangModel->getBarangWithKategori();
            $satuan = $this->barangModel->getBarangWithSatuan();
        }
        $data = [
            'satuan' => $satuan->findAll(),
            'barang' => $barang->findAll(),
            'pager' => $this->barangModel->pager
        ];
        echo view('v_header');
        return view('v_stok', $data);
    }

    public function tambahbarang()
    {
        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('foto');
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads', $newName);
                $foto_path = 'uploads/' . $newName;

                $newID = $this->kategoriModel->where('nama_kategori', $this->request->getPost('id_kategori'))->first();
                $idSat = $this->satuanModel->where('nama_satuan', $this->request->getPost('id_satuan'))->first();

                $data = [
                    'id_barang' => $this->request->getPost('id_barang'),
                    'nama' => $this->request->getPost('nama_barang'),
                    'foto' => $foto_path,
                    'stok' => $this->request->getPost('stok'),
                    'harga_beli' => $this->request->getPost('harga'),
                    'id_kategori' => $newID['id_kategori'],
                    'id_satuan' => $idSat['id_satuan'],
                ];

                if ($this->barangModel->insert($data)) {
                    return redirect()->to('/stok')->with('success', 'Barang berhasil ditambahkan');
                } else {
                    return redirect()->back()->with('error', 'Gagal menambahkan barang');
                }
            } else {
                return redirect()->back()->with('error', 'Foto tidak valid atau sudah dipindahkan');
            }
        } else {
            $data = [
                'kategori' => $this->kategoriModel->findAll(),
                'satuan' => $this->satuanModel->findAll()
            ];

            echo view('v_header');
            return view('v_tambah_barang', $data);
        }
    }
 
    // fungsi ke detail barang
    public function indexDetail()
    {
        $data = [
            'barang' => $this->barangModel->getBarangById($this->request->getVar('id_barang'))
        ];
        return view('admin\percobaan', $data);
    }

    // fungsi update barang
    public function updateBarang()
    {
        $barang = $this->barangModel->getBarangWithKategori();
        $satuan = $this->barangModel->getBarangWithSatuan();
        $data = [
            'barang' => $barang->findAll(),
            'satuan' => $satuan->findAll()
        ];
        echo view('v_header');
        echo view('admin\percobaan', $data);
        // $file = $this->request->getFile('foto');
        // if ($file->isValid() && !$file->hasMoved()) {
        //     $dataLama = $this->barangModel->getBarangById($this->request->getVar('id_barang'));
        //     $fotoLama = $dataLama['foto'];
        //     unlink($fotoLama);
        //     $newName = $file->getRandomName();
        //     $file->move(ROOTPATH . 'public/uploads', $newName);
        //     $foto_path = 'uploads/' . $newName;
        //     $newID = $this->kategoriModel->where('nama_kategori', $this->request->getVar('id_kategori'))->first();
        //     $idSat = $this->satuanModel->where('nama_satuan', $this->request->getVar('id_satuan'))->first();
        //     $data = [
        //         'id_barang' => $this->request->getVar('id_barang'),
        //         'nama' => $this->request->getVar('nama'),
        //         'foto' => $foto_path,
        //         'stok' => $this->request->getVar('stok'),
        //         'harga_beli' => $this->request->getVar('harga'),
        //         'id_kategori' => $newID['id_kategori'],
        //         'id_satuan' => $idSat['id_satuan'],
        //     ];
        //     $this->barangModel->update($this->request->getVar('id_barang'), $data);
        //     return redirect()->to(base_url('/stok'));
        //  } else {
        //     $newID = $this->kategoriModel->where('nama_kategori', $this->request->getVar('id_kategori'))->first();
        //     $idSat = $this->satuanModel->where('nama_satuan', $this->request->getVar('id_satuan'))->first();
        //     $data = [
        //         'id_barang' => $this->request->getVar('id_barang'),
        //         'nama' => $this->request->getVar('nama'),
        //         'foto' => $this->request->getVar('foto'),
        //         'stok' => $this->request->getVar('stok'),
        //         'harga_beli' => $this->request->getVar('harga'),
        //         'id_satuan' => $idSat['id_satuan'],
        //         'id_kategori' => $newID['id_kategori'],
        //     ];
        //     $this->barangModel->update($this->request->getVar('id_barang'), $data);
        //     return redirect()->to(base_url('/stok'));
        // }
    }

        public function deletebarang($id_barang = null)
    {
        if (!isset($id_barang) || $this->barangModel->find($id_barang) == null) {
            return redirect()->to('stok')->with('error', 'Barang tidak ditemukan');
        } else {
            // Find the item to get the associated file path
            $barang = $this->barangModel->find($id_barang);

            // Attempt to delete the record from the database
            if ($this->barangModel->delete($id_barang)) {
                // Attempt to delete the associated file
                $filePath = ROOTPATH . 'public/' . $barang['foto'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                return redirect()->to('stok')->with('success', 'Barang berhasil dihapus');
            } else {
                return redirect()->back()->with('error', 'Gagal menghapus barang');
            }
        }
    }

}