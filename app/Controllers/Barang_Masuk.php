<?php

namespace App\Controllers;


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
                return false;
            }
        }
        return true;
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
    public function update()
    {
        $session = session();
        $datalist = $session->get('datalist') ?? [];

        $index = $this->request->getPost('index');
        $column = $this->request->getPost('column');
        $value = $this->request->getPost('value');

        if (isset($datalist[$index])) {
            $datalist[$index][$column] = $value;
            $session->set('datalist', $datalist);
        }

        return $this->response->setJSON(['status' => 'success']);
    }

    public function cariStok()
    {
        $idBarang = $this->request->getPost('idBarang');


        if (!empty($idBarang)) {
            $a = $this->barangModel->where(
                'id_barang',
                $idBarang
            )->first();
            if (empty($a)) {
                session()->set('id_barang_temp', $idBarang);
                return $this->response->setJSON([
                    'status' => 'not_found',
                    'message' => 'Item not found. Please go to the input form to add this item.'
                ]);
            }
            if ($this->containsObjectWithName($this->dataList, $idBarang)) {
                $this->dataList[array_search($idBarang, array_values($this->dataList))]['stok'] += 1;
                session()->set('datalist', $this->dataList);
                return $this->response->setJSON(['status' => 'success']);
            }
            $data2 = [
                'id_barang' => $idBarang,
                'nama' => $a['nama'],
                'satuan' => $a['satuan'],
                // 'merk' => $a('merk'),
                'stok' => 1,
                'harga_beli' => $a['harga_beli'],
                // 'id_kategori' => $a('id_kategori'),
            ];
            $this->dataList[] = $data2;
            session()->set('datalist', $this->dataList);
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'eror']);
        }
    }
}
