<?php

namespace App\Controllers;


use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\BarangMasukModel;
use App\Models\InventarisModel;
use App\Models\MasterBarangMasukModel;
use App\Models\SatuanModel;
use App\Models\SupplierModel;

use function PHPUnit\Framework\isEmpty;

class Barang_Masuk extends BaseController
{
    protected $barangModel;
    protected $kategoriModel;
    protected $barangMasukModel;
    protected $masterBarangMasukModel;
    protected $supplierModel;
    protected $inventarisModel;
    protected $satuanModel;
    private $dataList = [];

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->kategoriModel = new KategoriModel();
        $this->satuanModel = new SatuanModel();
        $this->barangMasukModel = new BarangMasukModel();
        $this->masterBarangMasukModel = new MasterBarangMasukModel();
        $this->inventarisModel = new InventarisModel();
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
        $startDate = $this->request->getVar('start_date');
        $endDate = $this->request->getVar('end_date');

        if ($startDate && $endDate) {
            $masuk = $this->masterBarangMasukModel->getBarangMasukGabungFilter($startDate, $endDate);
        } else {
            $masuk = $this->masterBarangMasukModel->getAll()->findAll();
        }

        $data = [
            'masuk' => $masuk,
            'start_date' => $startDate,
            'end_date' => $endDate,
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
        if ($objects != null) {
            foreach ($objects as $object) {
                if ($object['id_barang'] == $name) {
                    return true;
                }
            }
        }
        return false;
    }
    public function saveData()
    {
        $idBarang = $this->request->getVar('id_barang');
        if ($this->containsObjectWithName($this->dataList, $idBarang)) {
            $data2 = [
                'id_barang' => $this->request->getVar('id_barang'),
                'nama' => $this->request->getVar('nama'),
                'satuan' => $this->request->getVar('satuan'),
                // 'merk' => $this->request->getVar('merk'),
                'jenis' => $this->request->getVar('jenis'),
                'stok' => 1,
                'harga_beli' => $this->request->getVar('harga_beli'),
                // 'id_kategori' => $this->request->getVar('id_kategori'),
            ];
            $this->dataList[] = $data2;
            session()->set('datalist', $this->dataList);
            return redirect()->to(base_url('/barang_masuk/index'));
        } else {
            $this->dataList[$this->getColumnValueIndices($this->dataList, 'id_barang', $idBarang)]['stok'] += 1;
            session()->set('datalist', $this->dataList);
            return redirect()->to(base_url('/barang_masuk/index'));
        }
    }
    public function index2()
    {
        $keyword = $this->request->getVar('search');
        if ($keyword) {
            $barang = $this->barangModel->getBarangByName($keyword);
            $inventaris = $this->inventarisModel->getByName($keyword);
        } else {
            $barang = $this->barangModel;
            $inventaris = $this->inventarisModel;
        }
        $data = [
            'barang' => $barang->findAll(),
            'inventaris' => $inventaris->findAll(),
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

                if ($b['jenis'] == 'barang') {
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
                } elseif ($b['jenis'] == 'alat') {
                    $barang1 = $this->inventarisModel->where('id_inventaris', $b['id_barang'])->first();
                    $data = [
                        'nama_inventaris' => $barang1['nama_inventaris'],
                        'foto' => $barang1['foto'],
                        'stok' => $barang1['stok'] + $b['stok'],
                        'harga_beli' => $b['harga_beli'],
                    ];

                    $this->inventarisModel->update($b['id_barang'], $data);

                    $this->barangMasukModel->insert(['id_inventaris' => $barang1['id_inventaris'], 'id_ms_barang_masuk' => $idms, 'jumlah' => $b['stok']]);
                }

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

    public function getColumnValueIndices(array $array, string $column, $value)
    {
        foreach ($array as $index => $item) {
            if (isset($item[$column]) && $item[$column] == $value) {
                return $index;
            }
        }
    }


    public function cariStok()
    {

        $idBarang = $this->request->getPost('idBarang');

        if (!empty($idBarang)) {
            $a = $this->barangModel->getBarangWithSatuan($idBarang)->first();
            $jenis = 'barang';
            if ($a == null) {
                $a = $this->inventarisModel->getById($idBarang)->first();
                $jenis = 'alat';
            }

            if (empty($a)) {
                session()->set('id_barang_temp', $idBarang);
                return $this->response->setJSON([
                    'status' => 'not_found',
                    'message' => 'Item not found. Please go to the input form to add this item.'
                ]);
            }
            if ($this->containsObjectWithName($this->dataList, $idBarang)) {
                $this->dataList[$this->getColumnValueIndices($this->dataList, 'id_barang', $idBarang)]['stok'] += 1;
                session()->set('datalist', $this->dataList);
                return $this->response->setJSON(['status' => 'success']);
            }
            if ($jenis == 'barang') {
                $data2 = [
                    'id_barang' => $a['id_barang'],
                    'nama' => $a['nama'],
                    'satuan' => $a['nama_satuan'],
                    'jenis' => $jenis,
                    'stok' => 1,
                    'harga_beli' => $a['harga_beli'],
                    // 'id_kategori' => $a('id_kategori'),
                ];
            } elseif ($jenis == 'alat') {
                $data2 = [
                    'id_barang' => $a['id_inventaris'],
                    'nama' => $a['nama_inventaris'],
                    'satuan' => 'alat',
                    'jenis' => $jenis,
                    'stok' => 1,
                    'harga_beli' => $a['harga_beli'],
                    // 'id_kategori' => $a('id_kategori'),
                ];
            }

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

    public function doubleForm()
    {
        $data = [
            'satuan' => $this->satuanModel->findAll(),
            'kategori' => $this->kategoriModel->findAll()
        ];
        echo view('v_header');
        return view('v_tambah_alat_barang', $data);
    }

    public function cariMaster()
    {
    }
}
