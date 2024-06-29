<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\BarangMasukModel;
use App\Models\MasterBarangMasukModel;


class Barang_Masuk extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;
    protected $barangMasukModel;
    protected $masterBarangMasukModel;
    private $dataList = [];

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
        $this->barangMasukModel = new BarangMasukModel();
        $this->masterBarangMasukModel = new MasterBarangMasukModel();
        $this->dataList = $this->loadExistingData();
    }

    public function index()
    {
        $data = [
            'barang' => session()->get('datalist'),
            'kategori' => $this->kategoriModel->findAll()
        ];
        echo view('v_header');
        return view('v_barang_masuk', $data);
    }
    public function loadExistingData()
    {
        session();

        return session()->get('datalist') ?? [];
    }
    function containsObjectWithName($objects, $name)
    {
        foreach ($objects as $object) {
            if ($object['id_barang'] !== $name) {
                return true;
            }
        }
        return false;
    }
    public function saveData()
    {
        if ($this->containsObjectWithName($this->dataList, $this->request->getVar('id_barang')) || $this->dataList == null) {
            $data2 = [
                'id_barang' => $this->request->getVar('id_barang'),
                'nama' => $this->request->getVar('nama'),
                'satuan' => $this->request->getVar('satuan'),
                // 'merk' => $this->request->getVar('merk'),
                'stok' => 1,
                'harga_beli' => $this->request->getVar('harga_beli'),
                // 'id_kategori' => $this->request->getVar('id_kategori'),
            ];
            $this->dataList[] = $data2;
            session()->set('datalist', $this->dataList);
            return redirect()->to(base_url('/barang_masuk'));
        } else {
            return redirect()->to(base_url('/barang_masuk'));
        }
    }
    public function index2()
    {
        $keyword = $this->request->getVar('search');
        if ($keyword) {
            $barang = $this->barangModel->getBarangByName($keyword);
        } else {
            $barang = $this->barangModel;
        }
        $data = [
            'barang' => $barang->findAll(),
            'kategori' => $this->kategoriModel->findAll()
        ];
        echo view('v_header');
        return view('v_cari_barang_masuk', $data);
    }
    public function clearSession()
    {
        session()->remove('datalist');
        return redirect()->to(base_url('/barang_masuk'));
        // return json_encode($this->barangModel->findAll());
    }
    public function updateStok()
    {
        $namasupplier = $this->request->getVar('supplier');
        $this->masterBarangMasukModel->insert(['waktu' => date("Y-m-d H:i:s"), 'id_supplier' => $namasupplier + 0]);

        $idms = $this->masterBarangMasukModel->getInsertID();
        $barang = session()->get('datalist');

        foreach ($barang as $b) {
            $barang1 = $this->barangModel->where('id_barang', $b['id_barang'])->first();
            $data = [
                'nama' => $barang1['nama'],
                'satuan' => $barang1['satuan'],
                'foto' => $barang1['foto'],
                'merk' => $barang1['merk'],
                'stok' => $barang1['stok'] + $b['stok'],
                'harga_beli' => $barang1['harga_beli'],
                'id_kategori' => $barang1['id_kategori'],
            ];

            $this->barangModel->update($b['id_barang'], $data);

            $this->barangMasukModel->insert(['id_barang' => $barang1['id_barang'], 'id_ms_barang_masuk' => $idms, 'jumlah' => $b['stok']]);
        }
        session()->remove('datalist');
        return redirect()->to(base_url('/barang_masuk'));
    }
}
