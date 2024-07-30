<?php

namespace App\Controllers;

use App\Models\InventarisModel;
use App\Models\MasterPeminjamanModel;
use App\Models\PeminjamanModel;
use App\Models\PenerimaModel;

use function PHPUnit\Framework\isEmpty;

class Barang_Pinjam extends BaseController
{
    protected $peminjamanModel;
    protected $penerimaModel;
    protected $masterPeminjamanModel;
    protected $inventarisModel;
    protected $dataList;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->penerimaModel = new PenerimaModel();
        $this->masterPeminjamanModel = new MasterPeminjamanModel();
        $this->inventarisModel = new InventarisModel();
        $this->dataList = session()->get('datalist_pinjam') ?? [];
    }

    public function index()
    {
        \Config\Services::validation();
        $data = [
            'pinjam' => session()->get('datalist_pinjam'),
        ];
        echo view('v_header');
        return view('v_peminjaman', $data);
    }

    public function index2()
    {
        $keyword = $this->request->getVar('search');
        if ($keyword) {
            $barang = $this->inventarisModel->getByName($keyword);
        } else {
            $barang = $this->inventarisModel;
        }
        $data = [
            'barang' => $barang->findAll()
        ];
        echo view('v_header');
        return view('v_cari_peminjaman', $data);
    }

    public function indexCari()
    {
        echo view('v_header');
        return view('v_cari_peminjaman');
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
            'pinjam' => $this->masterPeminjamanModel->getAllWithNama()->findAll(),
        ];
        echo view('v_header');
        return view('v_beranda_peminjaman', $data);
    }

    function containsObjectWithName($objects, $name)
    {
        if ($objects != null) {
            foreach ($objects as $object) {
                if ($object['id_inventaris'] == $name) {
                    return true;
                }
            }
            return false;
        } else {
            return false;
        }
    }

    public function clearSession()
    {
        session()->remove('datalist_pinjam');
        // ganti link
        return redirect()->to(base_url('/barang_pinjam'));
        // return json_encode($this->inventarisModel->findAll());
    }

    public function getColumnValueIndices(array $array, string $column, $value)
    {
        foreach ($array as $index => $item) {
            if (isset($item[$column]) && $item[$column] == $value) {
                return $index;
            }
        }
    }

    public function saveData()
    {
        $idInventaris = $this->request->getVar('id_inventaris');
        if ($this->containsObjectWithName($this->dataList, $idInventaris)) {
            $this->dataList[$this->getColumnValueIndices($this->dataList, 'id_inventaris', $idInventaris)]['stok'] += 1;
            session()->set('datalist_pinjam', $this->dataList);
            return redirect()->to(base_url('/barang_pinjam/index'));
        } else {
            $data2 = [
                'id_inventaris' => $this->request->getVar('id_inventaris'),
                'nama_inventaris' => $this->request->getVar('nama_inventaris'),
                // 'jenis' => $this->request->getVar('jenis'),
                'stok' => 1,
            ];
            $this->dataList[] = $data2;
            session()->set('datalist_pinjam', $this->dataList);
            return redirect()->to(base_url('/barang_pinjam/index'));
        }
    }

    public function updateStok()
    {
        if (!$this->validate([
            'nama_penerima' => 'required|is_not_unique[penerima.nama_penerima]'
        ])) {
            // ganti url
            return redirect()->to(base_url('/barang_pinjam/index'))->withInput();
        }
        $barang = session()->get('datalist_pinjam');
        if (!empty($barang)) {
            $namaPenerima = $this->request->getVar('nama_penerima');
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime =  date("Y-m-d H:i:s");
            $this->masterPeminjamanModel->insert(['waktu' => $currentDateTime, 'id_penerima' => $namaPenerima]);

            $idms = $this->masterPeminjamanModel->getInsertID();

            foreach ($barang as $b) {

                $barang1 = $this->inventarisModel->where('id_inventaris', $b['id_inventaris'])->first();
                if (isset($kembali)) {
                    $stok = $barang1['stok'] + $b['stok'];
                } else {
                    $stok =  $barang1['stok'] - $b['stok'];
                }
                $data = [
                    'nama_inventaris' => $barang1['nama_inventaris'],
                    'bukti_peminjaman' => $barang1['bukti_peminjaman'],
                    'stok' => $stok,
                ];

                $this->inventarisModel->update($b['id_inventaris'], $data);
                $this->peminjamanModel->insert(['id_inventaris' => $barang1['id_inventaris'], 'id_ms_peminjaman' => $idms, 'jumlah' => $b['stok']]);
            }


            session()->remove('datalist_pinjam');
            // ganti url
            return redirect()->to(base_url('/barang_pinjam'));
        } else {
            // ganti url
            return redirect()->to(base_url('/barang_pinjam/index'))->withInput();
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
            $session->set('datalist_pinjam', $datalist);
        }

        return $this->response->setJSON(['status' => 'success']);
    }

    public function cariStok()
    {
        $idInventaris = $this->request->getPost('id_inventaris');

        if (!empty($idInventaris)) {
            $a = $this->inventarisModel->where(
                'id_inventaris',
                $idInventaris
            )->first();
            if (empty($a)) {
                session()->set('id_barang_temp', $idInventaris);
                return $this->response->setJSON([
                    'status' => 'not_found',
                    'message' => 'Item not found. Please go to the input form to add this item.'
                ]);
            }
            if ($this->containsObjectWithName($this->dataList, $idInventaris) || $this->dataList != null) {
                $this->dataList[array_search($idInventaris, array_values($this->dataList))]['stok'] += 1;
                session()->set('datalist', $this->dataList);
                return $this->response->setJSON(['status' => 'success']);
            }
            $data2 = [
                'id_barang' => $idInventaris,
                'nama_inventaris' => $a['nama_inventaris'],
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

    public function updateStatus()
    {
        if ($this->request->getVar('status') == 'kembali') {
            $id = $this->request->getVar('id_ms_peminjaman');
            $data = $this->masterPeminjamanModel->where('id_ms_peminjaman')->first();
            date_default_timezone_set('Asia/Jakarta');
            $currentDateTime =  date("Y-m-d H:i:s");
            $newData = [
                'tanggal_pinjam' => $data['tanggal_pinjam'],
                'tanggal_kembali' => $currentDateTime,
                'id_penerima' => $data['id_penerima'],
                'status' => '0',
                'bukti_peminjaman' => $data['bukti_peminjaman']
            ];
            $this->masterPeminjamanModel->update($data['id_ms_peminjaman'], $newData);
        }
    }
}
