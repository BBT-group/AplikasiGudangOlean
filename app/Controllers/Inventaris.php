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
            'alat' => $this->inventarisModel->findAll(),
        ];
        echo view('v_header');
        return view('v_inventaris', $data);
    }

    public function indexTambah()
    {
        $dataAlat = [
            'inventaris' => $this->inventarisModel->findAll()
        ];

        echo view('v_header');
        return view('v_tambah_inventaris', $dataAlat);
    }

    public function simpanAlat()
    {
        if (!$this->validate([
            'id_inventaris' => 'required',
            'nama_inventaris' => 'required',
            'foto' => 'uploaded[foto]',
        ])) {
            return redirect()->to(base_url('inventaris/indextambah'))->withInput();
        }

        $file = $this->request->getFile('foto');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName);
            $foto_path = 'uploads/' . $newName;
            $dataAlat = [
                'id_inventaris' => $this->request->getVar('id_inventaris'),
                'nama_inventaris' => $this->request->getVar('nama_inventaris'),
                'foto' => $foto_path,
                'stok' => 0,
                'harga_beli' => 0
            ];
            if (!$this->inventarisModel->insertAlat($dataAlat)) {
                return redirect()->to('/inventaris')->with('success', 'Barang berhasil ditambahkan');
            } else {
                return redirect()->back()->with('error', 'Gagal menambahkan barang');
            }
        } else {
            return redirect()->back()->with('error', 'Foto tidak valid atau sudah dipindahkan');
        }
    }

    public function indexDetail($id_inventaris = null)
    {
        $data = [
            'alat' => $this->inventarisModel->getAlatById($id_inventaris)
        ];
        echo view('v_header');
        return view('admin\detailalat', $data);
    }

    public function indexUpdate($id_inventaris = null)
    {
        $data = [
            'alat' => $this->inventarisModel->getAlatById($id_inventaris)
        ];
        echo view('v_header');
        return view('v_update_inventaris', $data);
    }

    // fungsi update alat
    public function updateAlat()
    {
        if (!$this->validate([
            'id_inventaris' => 'required|is_not_unique[inventaris.id_inventaris]',
            'nama_inventaris' => 'required',
            'foto' => 'uploaded[foto]',
        ])) {
            return redirect()->back();
        }
        $file = $this->request->getFile('foto');
        if ($file->isValid() && !$file->hasMoved()) {
            $dataLama = $this->inventarisModel->getAlatById($this->request->getVar('id_inventaris'));
            $fotoLama = $dataLama['foto'];
            unlink($fotoLama);
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/', $newName);
            $foto_path = 'uploads/' . $newName;
        } else {
            $foto_path = $this->request->getFile('foto');
        }
        $data = [
            'nama_inventaris' => $this->request->getVar('nama_inventaris'),
            'foto' => $foto_path,
            'stok' => $this->request->getVar('stok'),
            'harga_beli' => $this->request->getVar('harga_beli'),
        ];
        if ($this->inventarisModel->update($this->request->getVar('id_inventaris'), $data)) {
            return redirect()->to(base_url('/inventaris'));
        }
        return redirect()->back()->withInput();
    }
}
