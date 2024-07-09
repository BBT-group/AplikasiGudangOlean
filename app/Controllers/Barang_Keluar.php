<?php

namespace App\Controllers;


use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\BarangKeluarModel;
use App\Models\MasterBarangKeluarModel;


class Barang_Keluar extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;
    protected $barangKeluarModel;
    protected $masterBarangKeluarModel;
    private $dataList = [];

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
        $this->barangKeluarModel = new BarangKeluarModel();
        $this->masterBarangKeluarModel = new MasterBarangKeluarModel();
        $this->dataList = $this->loadExistingData();
    }

    public function index()
    {
        $data = [
            'barang' => session()->get('datalist_keluar'),
            'kategori' => $this->kategoriModel->findAll()
        ];
        echo view('v_header');
        return view('v_barang_keluar', $data);
    }

    public function beranda()
    {
        $data = [
            'keluar' => $this->masterBarangKeluarModel->getAll(),
        ];
        echo view('v_header');
        return view('v_beranda_barang_keluar', $data);
    }

    public function loadExistingData()
    {
        return session()->get('datalist_keluar') ?? [];
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
        $idBarang = $this->request->getVar('id_barang');
        if (!$this->containsObjectWithName($this->dataList, $idBarang) || $this->dataList == null) {
            $data2 = [
                'id_barang' => $this->request->getVar('id_barang'),
                'nama' => $this->request->getVar('nama'),
                'satuan' => $this->request->getVar('satuan'),
                'stok' => 1,

            ];
            $this->dataList[] = $data2;
            session()->set('datalist_keluar', $this->dataList);
            return redirect()->to(base_url('/barang_keluar/index'));
        } else {
            $this->dataList[array_search($idBarang, array_values($this->dataList))]['stok'] += 1;
            session()->set('datalist_keluar', $this->dataList);
            return redirect()->to(base_url('/barang_keluar/index'));
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
        return view('v_cari_barang_keluar', $data);
    }
    public function clearSession()
    {
        session()->remove('datalist_keluar');
        return redirect()->to(base_url('/barang_keluar'));
    }
    public function updateStok()
    {
        if (!$this->validate([
            'penerima' => 'required|is_not_unique[penerima.id_penerima]'
        ])) {
            return redirect()->to(base_url('/barang_keluar/index'))->withInput();
        }
        $barang = session()->get('datalist_keluar');
        if (!empty($barang)) {
            $namaPenerima = $this->request->getVar('penerima');
            $this->masterBarangKeluarModel->insert(['waktu' => date("Y-m-d H:i:s"), 'id_penerima' => $namaPenerima]);

            $idms = $this->masterBarangKeluarModel->getInsertID();


            foreach ($barang as $b) {
                $barang1 = $this->barangModel->where('id_barang', $b['id_barang'])->first();
                $data = [
                    'nama' => $barang1['nama'],
                    'satuan' => $barang1['satuan'],
                    'foto' => $barang1['foto'],
                    'merk' => $barang1['merk'],
                    'stok' => $barang1['stok'] - $b['stok'],
                    'harga_beli' => $barang1['harga_beli'],
                    'id_kategori' => $barang1['id_kategori'],
                ];

                $this->barangModel->update($b['id_barang'], $data);

                $this->barangKeluarModel->insert(['id_barang' => $barang1['id_barang'], 'id_ms_barang_keluar' => $idms, 'jumlah' => $b['stok']]);
            }
            session()->remove('datalist_keluar');
            return redirect()->to(base_url('/barang_keluar'));
        } else {
            return redirect()->to(base_url('/barang_keluar/index'))->withInput();
        }
    }
    public function update()
    {
        $session = session();
        $datalist = $session->get('datalist_keluar') ?? [];

        $index = $this->request->getPost('index');
        $column = $this->request->getPost('column');
        $value = $this->request->getPost('value');

        if (isset($datalist[$index])) {
            $datalist[$index][$column] = $value;
            $session->set('datalist_keluar', $datalist);
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
