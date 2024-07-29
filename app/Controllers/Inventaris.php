<?php

namespace App\Controllers;

use App\Models\InventarisModel;

class Inventaris extends BaseController
{
    protected $inventarisModel;

    public function __construct()
    {
        $this->inventarisModel = new InventarisModel();
    }

    public function index()
    {
        $data = [
            'barang' => $this->inventarisModel->findAll(),
        ];
        echo view('v_header');
        return view('v_tambah_barang', $data);
    }

    public function indexTambah()
    {
        return view('v_tambah_barang');
    }

    public function indexUpdate()
    {
        $data = [
            'barang' => $this->inventarisModel->where('id_inventaris', $this->request->getVar('id_inventaris'))->first(),
        ];
        echo view('v_header');
        return view('v_tambah_barang', $data);
    }

    public function indexDetail()
    {
        $data = [
            'barang' => $this->inventarisModel->where('id_inventaris', $this->request->getVar('id_inventaris'))->first(),
        ];
        echo view('v_header');
        return view('v_tambah_barang', $data);
    }

    public function simpanAlat()
    {
        if (!$this->validate([
            'id_inventaris' => 'required|is_unique[inventaris.id_inventaris]',
            'nama_inventaris' => 'required',
            'bukti_peminjaman' => 'required',

        ])) {
            return redirect()->to(base_url('/barangtambah/index'));
        }

        $file = $this->request->getFile('bukti_peminjaman');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName);
            $foto_path = 'uploads/' . $newName;
            $data = [
                'id_inventaris' => $this->request->getVar('id_inventaris'),
                'nama_inventaris' => $this->request->getVar('nama_inventaris'),
                'bukti_peminjaman' => $foto_path,
                'stok' => 0,
                'harga_beli' => 0
            ];
            $this->inventarisModel->insertBarang($data);
            return redirect()->to(base_url('/stok'));
        }
    }


    // fungsi update barang
    public function updateAlat()
    {
        if (!$this->validate([
            'id_inventaris' => 'required|is_unique[inventaris.id_inventaris]',
            'nama_inventaris' => 'required',
            'bukti_peminjaman' => 'required',
        ])) {
            return redirect()->to(base_url('/barangtambah/index'));
        }
        $file = $this->request->getFile('bukti_peminjaman');
        if ($file->isValid() && !$file->hasMoved()) {
            $dataLama = $this->inventarisModel->getAlatById($this->request->getVar('id_inventaris'));
            $fotoLama = $dataLama['bukti_peminjaman'];
            unlink($fotoLama);
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName);
            $foto_path = 'uploads/' . $newName;
        } else {
            $foto_path = $this->request->getVar('foto');
        }
        $data = [
            'nama_inventaris' => $this->request->getVar('nama_inventaris'),
            'bukti_peminjaman' => $foto_path,
            'stok' => $this->request->getVar('stok'),
            'harga_beli' => $this->request->getVar('harga_beli'),
        ];
        $this->inventarisModel->update($this->request->getVar('id_inventaris'), $data);
        return redirect()->to(base_url('/stok'));
    }
}
