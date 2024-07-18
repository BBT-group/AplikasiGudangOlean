<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\MasterPeminjamanModel;
use App\Models\PeminjamanModel;
use App\Models\PenerimaModel;

use function PHPUnit\Framework\isEmpty;

class Barang_Pinjam extends BaseController
{
    protected $peminjamanModel;
    protected $penerimaModel;
    protected $masterPeminjamanModel;
    protected $barangModel;
    protected $dataList;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->penerimaModel = new PenerimaModel();
        $this->masterPeminjamanModel = new MasterPeminjamanModel();
        $this->barangModel = new BarangModel();
        $this->dataList = session()->get('datalist_pinjam') ?? [];
    }

    public function index()
    {
        echo view('v_header');
        return view('v_beranda_peminjaman');
    }

    public function indexPinjam()
    {
        echo view('v_header');
        return view('v_peminjaman');
    }

    public function indexCari()
    {
        echo view('v_header');
        return view('v_cari_peminjaman');
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

    public function clearSession()
    {
        session()->remove('datalist_pinjam');
        // ganti link
        return redirect()->to(base_url('/barang_masuk'));
        // return json_encode($this->barangModel->findAll());
    }

    public function saveData()
    {
        $idBarang = $this->request->getVar('id_barang');
        if ($this->containsObjectWithName($this->dataList, $idBarang) == false || $this->dataList == null) {
            $data2 = [
                'id_barang' => $this->request->getVar('id_barang'),
                'nama' => $this->request->getVar('nama'),
                'id_satuan' => $this->request->getVar('id_satuan'),
                // 'jenis' => $this->request->getVar('jenis'),
                'stok' => 1,
            ];
            $this->dataList[] = $data2;
            session()->set('datalist_pinjam', $this->dataList);
            return redirect()->to(base_url('/barang_masuk/index'));
        } else {
            $this->dataList[array_search($idBarang, array_values($this->dataList))]['stok'] += 1;
            session()->set('datalist', $this->dataList);
            return redirect()->to(base_url('/barang_masuk/index'));
        }
    }

    public function updateStok()
    {
        if (!$this->validate([
            'penerima' => 'required|is_not_unique[supplier.id_supplier]'
        ])) {
            // ganti url
            return redirect()->to(base_url('/barang_masuk/index'))->withInput();
        }
        $barang = session()->get('datalist_pinjam');
        if (!empty($barang)) {
            $namaPenerima = $this->request->getVar('penerima');
            $this->masterPeminjamanModel->insert(['waktu' => date("Y-m-d H:i:s"), 'id_penerima' => $namaPenerima]);

            $idms = $this->masterPeminjamanModel->getInsertID();

            foreach ($barang as $b) {

                $barang1 = $this->barangModel->where('id_barang', $b['id_barang'])->first();
                if (isset('kembali')) {
                    $stok = $barang1['stok'] + $b['stok'];
                } else {
                    $stok =  $barang1['stok'] - $b['stok'];
                }
                $data = [
                    'nama' => $barang1['nama'],
                    'id_satuan' => $barang1['id_satuan'],
                    'foto' => $barang1['foto'],
                    'jenis' => $barang1['jenis'],
                    'stok' => $stok,
                    'harga_beli' => $b['harga_beli'],
                    'id_kategori' => $barang1['id_kategori'],
                ];

                $this->barangModel->update($b['id_barang'], $data);

                $this->peminjamanModel->insert(['id_barang' => $barang1['id_barang'], 'id_ms_peminjaman' => $idms, 'jumlah' => $b['stok']]);

                session()->remove('datalist_pinjam');
                // ganti url
                return redirect()->to(base_url('/barang_masuk'));
            }
        } else {
            // ganti url
            return redirect()->to(base_url('/barang_masuk/index'))->withInput();
        }
    }

    public function update()
    {
        $session = session();
        $datalist = $session->get('datalist_pinjam') ?? [];

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
                'id_satuan' => $a['id_satuan'],
                'stok' => 1,
            ];
            $this->dataList[] = $data2;
            session()->set('datalist_pinjam', $this->dataList);
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'eror']);
        }
    }

    public function hapusBarangDatalistPinjam()
    {
        $session = session();
        $items = $session->get('datalist_pinjam') ?? [];

        $index = $this->request->getPost('index');

        if (isset($items[$index])) {
            unset($items[$index]);
            $session->set('datalist_pinjam', $items);
        }
        return $this->response->setJSON(['status' => 'success']);
    }
}
