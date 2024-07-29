<?php

namespace App\Controllers;


use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\BarangMasukModel;
use App\Models\MasterBarangMasukModel;
use App\Models\SupplierModel;

use function PHPUnit\Framework\isEmpty;

class Barang_Masuk extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;
    protected $barangMasukModel;
    protected $masterBarangMasukModel;
    protected $supplierModel;
    private $dataList = [];

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
        $this->barangMasukModel = new BarangMasukModel();
        $this->masterBarangMasukModel = new MasterBarangMasukModel();
        $this->supplierModel = new SupplierModel();
        $this->dataList = $this->loadExistingData();
    }

    public function index()
    {
        $data = [
            'barang' => session()->get('datalist'),
        ];
        echo view('v_header');
        return view('v_barang_masuk', $data);
    }

    // fungsi tampil detail barang masuk
    public function indexDetailMaster()
    {
        $idBarang = $this->request->getVar('id_ms_barang_masuk');
        $data = [
            // mengambil header ms barang masuk yaitu nama supp, tanggal, id master barang
            'header' => $this->masterBarangMasukModel->getById($idBarang),
            // mengambil data yang memiliki id ms barang masuk
            'barang' => $this->barangMasukModel->getByMasterId($idBarang)
        ];
        echo view('v_header');
        // ganti url ke detail
        return view('v_barang_masuk', $data);
    }
    public function beranda()
    {
        // $keyword = $this->request->getVar('search');
        // if ($keyword) {
        //     $masuk = $this->masterBarangMasukModel->getBarangByName($keyword);
        // } else {
        //     $masuk = $this->masterBarangMasukModel;
        // }
        $data = [
            'masuk' => $this->masterBarangMasukModel->getAll()->findAll(),
        ];
        echo view('v_header');
        return view('v_beranda_barang_masuk', $data);
    }

    public function loadExistingData()
    {
        session();

        return session()->get('datalist') ?? [];
    }
    function containsObjectWithName($objects, $name)
    {
        if (!isEmpty($objects)) {
            foreach ($objects as $object) {
                if ($object['id_barang'] !== $name) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }
    public function saveData()
    {
        $idBarang = $this->request->getVar('id_barang');
        if ($this->containsObjectWithName($this->dataList, $idBarang) == false || $this->dataList == null) {
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
            return redirect()->to(base_url('/barang_masuk/index'));
        } else {
            $this->dataList[array_search($idBarang, array_values($this->dataList))]['stok'] += 1;
            session()->set('datalist', $this->dataList);
            return redirect()->to(base_url('/barang_masuk/index'));
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
        if (!$this->validate([
            'nama_supplier' => 'required'
        ])) {
            return redirect()->to(base_url('/barang_masuk/index'))->withInput();
        }
        $barang = session()->get('datalist');
        if (!empty($barang)) {
            $namasupplier = $this->request->getVar('nama_supplier');
            if ($this->supplierModel->where('nama', $namasupplier)->first() == null) {
                $suppId = $this->supplierModel->insert(['nama' =>
                $namasupplier], true);
            } else {
                $supp = $this->supplierModel->where('nama', $namasupplier)->first();
                $suppId = $supp['id_supplier'];
            }
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime =  date("Y-m-d H:i:s");
            $this->masterBarangMasukModel->insert(['waktu' => $currentDateTime, 'id_supplier' => $suppId]);

            $idms = $this->masterBarangMasukModel->getInsertID();

            foreach ($barang as $b) {
                $barang1 = $this->barangModel->where('id_barang', $b['id_barang'])->first();
                $data = [
                    'nama' => $barang1['nama'],
                    'id_satuan' => $barang1['id_satuan'],
                    'foto' => $barang1['foto'],

                    'stok' => $barang1['stok'] + $b['stok'],
                    'harga_beli' => $b['harga_beli'],
                    'id_kategori' => $barang1['id_kategori'],
                ];

                $this->barangModel->update($b['id_barang'], $data);

                $this->barangMasukModel->insert(['id_barang' => $barang1['id_barang'], 'id_ms_barang_masuk' => $idms, 'jumlah' => $b['stok']]);

                session()->remove('datalist');
                return redirect()->to(base_url('/barang_masuk'));
            }
        } else {
            return redirect()->to(base_url('/barang_masuk/index'))->withInput();
        }
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
            if ($this->containsObjectWithName($this->dataList, $idBarang) || $this->dataList != null) {
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
    public function hapusBarangDatalistMasuk()
    {
        $session = session();
        $items = $session->get('datalist') ?? [];

        $index = $this->request->getPost('index');

        if (isset($items[$index])) {
            unset($items[$index]);
            $session->set('datalist', $items);
        }
        return $this->response->setJSON(['status' => 'success']);
    }



    public function cariMaster()
    {
    }
}
